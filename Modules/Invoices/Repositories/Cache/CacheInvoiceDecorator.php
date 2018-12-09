<?php

namespace Modules\Invoices\Repositories\Cache;

use Modules\Invoices\Repositories\InvoiceRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheInvoiceDecorator extends BaseCacheDecorator implements InvoiceRepository
{
    public function __construct(InvoiceRepository $invoice)
    {
        parent::__construct();
        $this->entityName = 'invoices.invoices';
        $this->repository = $invoice;
    }
}
