# Sales Module

The Sales module manages client-facing financial interactions.

## Overview

This module is responsible for billing clients, sending estimates, and recording payments. It is critical for the revenue generation aspect of the business.

## Key Features

*   **Estimates**: Create and send cost estimates to clients.
*   **Invoices**: Generate invoices from estimates or from scratch.
*   **Calculations**: Auto-calculate sub-totals, taxes, and grand totals.
*   **PDF Generation**: Download estimates/invoices as PDFs.
*   **Expenses**: Record business expenses (billable or non-billable).
*   **Taxes**: Configure tax rates (VAT, GST, etc.).

## Models & Database

| Model | Table | Description |
| :--- | :--- | :--- |
| `Estimate` | `estimates` | Cost estimate record. |
| `EstimateItem` | `estimate_items` | Line items (Product, Qty, Rate). |
| `Invoice` | `invoices` | Official invoice record. |
| `InvoiceItem` | `invoice_items` | Line items for invoices. |
| `Tax` | `taxes` | Tax definitions. |
| `Expense` | `expenses` | Company expenses. |

## Workflow

1.  **Create Estimate**: Staff creates an estimate for a potential project.
2.  **Client Approval**: (Offline or via portal) Client approves estimate.
3.  **Convert to Invoice**: Estimate is converted to an Invoice.
4.  **Send to Client**: Invoice is emailed to the client.
5.  **Payment**: Staff records payment against the invoice.

## Routes

Prefix: `/sales`

| Method | URI | Controller |
| :--- | :--- | :--- |
| RESOURCE | `/sales/invoices` | `InvoicesController` |
| RESOURCE | `/sales/estimates` | `EstimatesController` |
| RESOURCE | `/sales/taxes` | `TaxesController` |
| RESOURCE | `/sales/expenses` | `ExpensesController` |
