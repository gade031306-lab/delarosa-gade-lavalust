import { useCallback, useEffect, useState } from 'react';

const API_URL = (import.meta.env.VITE_API_URL || '').replace(/\/+$/, '');
const EMPTY_PRODUCT = {
  product_name: '',
  description: '',
  price: '',
  quantity: '',
};

function storedSession() {
  try {
    return JSON.parse(localStorage.getItem('product-desk-session') || 'null');
  } catch {
    localStorage.removeItem('product-desk-session');
    return null;
  }
}

async function parseResponse(response) {
  const text = await response.text();
  let data = {};

  if (text) {
    try {
      data = JSON.parse(text);
    } catch {
      throw new Error(`The API returned an unexpected response (HTTP ${response.status}).`);
    }
  }

  if (!response.ok) {
    throw new Error(data.error || `Request failed (HTTP ${response.status}).`);
  }

  return data;
}

export default function App() {
  const [session, setSession] = useState(storedSession);
  const [products, setProducts] = useState([]);
  const [authMode, setAuthMode] = useState('login');
  const [authForm, setAuthForm] = useState({ username: '', email: '', password: '' });
  const [productForm, setProductForm] = useState(EMPTY_PRODUCT);
  const [editingId, setEditingId] = useState(null);
  const [busy, setBusy] = useState(false);
  const [error, setError] = useState('');
  const [notice, setNotice] = useState('');

  const saveSession = useCallback((nextSession) => {
    localStorage.setItem('product-desk-session', JSON.stringify(nextSession));
    setSession(nextSession);
  }, []);

  const clearSession = useCallback(() => {
    localStorage.removeItem('product-desk-session');
    setSession(null);
    setProducts([]);
    setEditingId(null);
    setProductForm(EMPTY_PRODUCT);
  }, []);

  const apiRequest = useCallback(async (path, options = {}) => {
    if (!API_URL) {
      throw new Error('Set VITE_API_URL to your LavaLust API address in the frontend environment.');
    }

    const { method = 'GET', body, authenticated = true, retry = true } = options;
    const send = (accessToken) => fetch(`${API_URL}${path}`, {
      method,
      headers: {
        ...(body === undefined ? {} : { 'Content-Type': 'application/json' }),
        ...(authenticated && accessToken
          ? { Authorization: `Bearer ${accessToken}` }
          : {}),
      },
      ...(body === undefined ? {} : { body: JSON.stringify(body) }),
    });

    let response = await send(session?.tokens?.access_token);
    if (
      response.status === 401 &&
      authenticated &&
      retry &&
      session?.tokens?.refresh_token
    ) {
      let refreshResponse;
      try {
        refreshResponse = await fetch(`${API_URL}/api/auth/refresh`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ refresh_token: session.tokens.refresh_token }),
        });
        const refreshed = await parseResponse(refreshResponse);
        const nextSession = { ...session, tokens: refreshed.tokens };
        saveSession(nextSession);
        response = await send(refreshed.tokens.access_token);
      } catch (refreshError) {
        clearSession();
        throw refreshError;
      }
    }

    return parseResponse(response);
  }, [clearSession, saveSession, session]);

  const loadProducts = useCallback(async () => {
    const data = await apiRequest('/api/products');
    if (!Array.isArray(data)) {
      throw new Error('The products endpoint did not return a product list.');
    }
    setProducts(data);
  }, [apiRequest]);

  useEffect(() => {
    if (!session?.tokens?.access_token) {
      setProducts([]);
      return undefined;
    }

    let active = true;
    apiRequest('/api/products')
      .then((data) => {
        if (!Array.isArray(data)) {
          throw new Error('The products endpoint did not return a product list.');
        }
        if (active) setProducts(data);
      })
      .catch((requestError) => {
        if (active) setError(requestError.message);
      });

    return () => {
      active = false;
    };
  }, [apiRequest, session?.tokens?.access_token]);

  async function submitAuth(event) {
    event.preventDefault();
    setBusy(true);
    setError('');
    setNotice('');

    try {
      const isRegister = authMode === 'register';
      const data = await apiRequest(`/api/auth/${isRegister ? 'register' : 'login'}`, {
        method: 'POST',
        authenticated: false,
        retry: false,
        body: isRegister
          ? authForm
          : { username: authForm.username, password: authForm.password },
      });
      saveSession({ user: data.user, tokens: data.tokens });
      setAuthForm({ username: '', email: '', password: '' });
      setNotice(isRegister ? 'Your account is ready.' : 'You are signed in.');
    } catch (requestError) {
      setError(requestError.message);
    } finally {
      setBusy(false);
    }
  }

  async function submitProduct(event) {
    event.preventDefault();
    setBusy(true);
    setError('');
    setNotice('');

    const body = {
      product_name: productForm.product_name.trim(),
      description: productForm.description.trim(),
      price: Number(productForm.price),
      quantity: Number(productForm.quantity),
    };

    try {
      await apiRequest(
        editingId ? `/api/products/${editingId}` : '/api/products',
        { method: editingId ? 'PUT' : 'POST', body },
      );
      await loadProducts();
      setProductForm(EMPTY_PRODUCT);
      setEditingId(null);
      setNotice(editingId ? 'Product updated.' : 'Product added.');
    } catch (requestError) {
      setError(requestError.message);
    } finally {
      setBusy(false);
    }
  }

  function startEditing(product) {
    setEditingId(product.id);
    setProductForm({
      product_name: product.product_name,
      description: product.description || '',
      price: product.price,
      quantity: product.quantity,
    });
    setError('');
    setNotice('');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  async function deleteProduct(id) {
    if (!window.confirm('Delete this product? This action cannot be undone.')) return;
    setError('');
    setNotice('');

    try {
      await apiRequest(`/api/products/${id}`, { method: 'DELETE' });
      setProducts((current) => current.filter((product) => String(product.id) !== String(id)));
      setNotice('Product deleted.');
    } catch (requestError) {
      setError(requestError.message);
    }
  }

  async function logout() {
    setError('');
    try {
      await apiRequest('/api/auth/logout', {
        method: 'POST',
        body: { refresh_token: session.tokens.refresh_token },
      });
    } catch (requestError) {
      setError(requestError.message);
    } finally {
      clearSession();
      setNotice('You have been logged out.');
    }
  }

  if (!session?.tokens?.access_token) {
    return (
      <main className="auth-page">
        <section className="welcome-panel">
          <div className="brand inverse"><span className="brand-icon">P</span> Product Desk</div>
          <div className="welcome-copy">
            <p className="eyebrow">LAVALUST PRODUCT MANAGEMENT</p>
            <h1>Make room for<br /><em>good things.</em></h1>
            <p>A thoughtful little space to manage your products and keep your inventory in order.</p>
          </div>
          <div className="welcome-note">Your inventory, in good company.</div>
        </section>

        <section className="auth-area">
          <div className="auth-card">
            <div className="mobile-brand brand"><span className="brand-icon">P</span> Product Desk</div>
            <p className="eyebrow">{authMode === 'login' ? 'WELCOME BACK' : 'JOIN PRODUCT DESK'}</p>
            <h2>{authMode === 'login' ? 'Sign in to continue' : 'Create an account'}</h2>
            <p className="subcopy">Your LavaLust API account keeps your products secure.</p>
            {error && <div className="message error" role="alert">{error}</div>}
            {notice && <div className="message success" role="status">{notice}</div>}
            <form className="form-stack" onSubmit={submitAuth}>
              <label>
                Username
                <input
                  autoComplete="username"
                  value={authForm.username}
                  onChange={(event) => setAuthForm({ ...authForm, username: event.target.value })}
                  required
                />
              </label>
              {authMode === 'register' && (
                <label>
                  Email address
                  <input
                    type="email"
                    autoComplete="email"
                    value={authForm.email}
                    onChange={(event) => setAuthForm({ ...authForm, email: event.target.value })}
                    required
                  />
                </label>
              )}
              <label>
                Password
                <input
                  type="password"
                  autoComplete={authMode === 'login' ? 'current-password' : 'new-password'}
                  minLength={authMode === 'register' ? 8 : undefined}
                  value={authForm.password}
                  onChange={(event) => setAuthForm({ ...authForm, password: event.target.value })}
                  required
                />
              </label>
              <button className="button primary" disabled={busy}>
                {busy ? 'Please wait…' : authMode === 'login' ? 'Sign in' : 'Create account'}
              </button>
            </form>
            <p className="auth-switch">
              {authMode === 'login' ? 'New to Product Desk?' : 'Already have an account?'}{' '}
              <button
                type="button"
                className="link-button"
                onClick={() => {
                  setAuthMode(authMode === 'login' ? 'register' : 'login');
                  setError('');
                  setNotice('');
                }}
              >
                {authMode === 'login' ? 'Create an account' : 'Sign in'}
              </button>
            </p>
            {!API_URL && (
              <p className="config-hint">Set <code>VITE_API_URL</code> to connect to your API.</p>
            )}
          </div>
        </section>
      </main>
    );
  }

  return (
    <main className="dashboard">
      <header className="topbar">
        <a className="brand" href="/" aria-label="Product Desk">
          <span className="brand-icon">P</span><span>Product Desk</span>
        </a>
        <div className="account">
          <span className="avatar">{session.user?.username?.slice(0, 1)?.toUpperCase() || 'U'}</span>
          <span className="account-name">{session.user?.username}</span>
          <button className="button secondary" onClick={logout}>Sign out</button>
        </div>
      </header>

      <section className="dashboard-heading">
        <div>
          <p className="eyebrow">YOUR INVENTORY</p>
          <h1>Products</h1>
          <p className="subcopy">A clear view of everything you have in stock.</p>
        </div>
        <div className="stat-card">
          <span className="stat-number">{products.length}</span>
          <span className="stat-label">PRODUCTS</span>
        </div>
      </section>

      {error && <div className="message error page-message" role="alert">{error}</div>}
      {notice && <div className="message success page-message" role="status">{notice}</div>}

      <section className="dashboard-grid">
        <div className="card catalog-card">
          <div className="card-heading">
            <div>
              <p className="eyebrow">CATALOG</p>
              <h2>Product list</h2>
            </div>
            <span className="count-pill">{products.length} items</span>
          </div>
          {products.length === 0 ? (
            <div className="empty-state">
              <span className="empty-mark">＋</span>
              <h3>Nothing here yet</h3>
              <p>Add a product to start building your catalog.</p>
            </div>
          ) : (
            <div className="table-wrap">
              <table>
                <thead>
                  <tr><th>Product</th><th>Price</th><th>Quantity</th><th /></tr>
                </thead>
                <tbody>
                  {products.map((product) => (
                    <tr key={product.id}>
                      <td>
                        <strong>{product.product_name}</strong>
                        <span className="description">{product.description}</span>
                      </td>
                      <td className="price">${Number(product.price).toFixed(2)}</td>
                      <td><span className="stock">{product.quantity} in stock</span></td>
                      <td className="row-actions">
                        <button className="link-button" onClick={() => startEditing(product)}>Edit</button>
                        <button className="link-button delete-link" onClick={() => deleteProduct(product.id)}>Delete</button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}
        </div>

        <aside className="card editor-card">
          <div className="card-heading">
            <div>
              <p className="eyebrow">{editingId ? 'EDIT ITEM' : 'NEW ITEM'}</p>
              <h2>{editingId ? 'Update product' : 'Add a product'}</h2>
            </div>
            {editingId && (
              <button
                type="button"
                className="link-button"
                onClick={() => {
                  setEditingId(null);
                  setProductForm(EMPTY_PRODUCT);
                }}
              >
                Cancel
              </button>
            )}
          </div>
          <form className="form-stack" onSubmit={submitProduct}>
            <label>
              Product name
              <input
                maxLength={100}
                value={productForm.product_name}
                onChange={(event) => setProductForm({ ...productForm, product_name: event.target.value })}
                placeholder="e.g. Everyday tote"
                required
              />
            </label>
            <label>
              Description
              <textarea
                rows="4"
                value={productForm.description}
                onChange={(event) => setProductForm({ ...productForm, description: event.target.value })}
                placeholder="What makes this product special?"
                required
              />
            </label>
            <div className="field-row">
              <label>
                Price
                <span className="price-input">
                  <span>$</span>
                  <input
                    type="number"
                    min="0"
                    step="0.01"
                    value={productForm.price}
                    onChange={(event) => setProductForm({ ...productForm, price: event.target.value })}
                    required
                  />
                </span>
              </label>
              <label>
                Quantity
                <input
                  type="number"
                  min="0"
                  step="1"
                  value={productForm.quantity}
                  onChange={(event) => setProductForm({ ...productForm, quantity: event.target.value })}
                  required
                />
              </label>
            </div>
            <button className="button primary" disabled={busy}>
              {busy ? 'Saving…' : editingId ? 'Save changes' : 'Add product'}
            </button>
          </form>
        </aside>
      </section>
      <footer className="footer">Product Desk <span>·</span> Powered by LavaLust API</footer>
    </main>
  );
}
