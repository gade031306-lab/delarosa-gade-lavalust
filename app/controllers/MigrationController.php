<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class MigrationController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('migration');
    }

    public function create_migration($migration_class)
    {
        $this->block_production_http_access();
        $this->migration->create_migration($migration_class);
    }

    public function migrate()
    {
        $this->block_production_http_access();
        $this->migration->migrate();
    }

    public function rollback()
    {
        $this->block_production_http_access();
        $this->migration->rollback();
    }

    public function rollback_all()
    {
        $this->block_production_http_access();
        $this->migration->rollback_all();
    }

    public function refresh()
    {
        $this->block_production_http_access();
        $this->migration->refresh();
    }

    public function status()
    {
        $this->block_production_http_access();
        $this->migration->status();
    }

    private function block_production_http_access()
    {
        if (
            PHP_SAPI !== 'cli' &&
            strtolower((string) getenv('APP_ENV')) === 'production'
        ) {
            show_404();
        }
    }
}