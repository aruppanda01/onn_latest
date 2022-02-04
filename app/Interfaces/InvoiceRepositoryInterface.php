<?php

namespace App\Interfaces;

interface InvoiceRepositoryInterface
{
    public function getAllInvoices();
    public function findInvoiceById(int $id);
    public function createInvoiceDetails(array $invoiceDetails);
    public function updateInvoiceDetails(array $invoiceDetails);
}
