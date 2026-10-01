# AGENTS.md — Laravel Coding Standards

Stack: Laravel + Eloquent ORM. Every change must follow these rules.

## Core Principle
```
Request → Eloquent Query Builder → when()/switch → joins/subqueries
         → selectRaw()/CASE WHEN → SQL filter+aggregate+sort → paginate() → response
```
Push all filtering, calculation, aggregation, and sorting into SQL. PHP stays thin.

## 1. Tenant ID
Use `$request->tenant_id` directly, inline, everywhere tenant filtering applies.
- :x: `$tenantId = $request->tenant_id ?? auth()->user()?->tenant_id ?? 1;`
- :x: `auth()->user()->tenant_id`
- :x: Any invented fallback (`?? 1`, default tenant, default account)
- :white_check_mark: `->where('transactions.tenant_id', $request->tenant_id)`
- :white_check_mark: `->where('transactions.created_by', $request->user()->id)`

## 2. Query Building
- Model-based queries only: `Transaction::query()`, `Account::query()`.
- No `DB::table()` / `DB::query()` / `DB::raw()`.
- Filters via `when()` with the **value-callback form** (not `fn($q) =>`):
  ```php
  ->when($request->from, function ($q, $from) {
      $q->whereDate('transactions.transaction_date', '>=', $from);
  })
  ```
- Explicit `leftJoin()` / `leftJoinSub()` over loading relationships and processing in PHP.

## 3. No PHP-Side Data Processing
Never use `foreach`, `map()`, `filter()`, `each()`, `reduce()`, or manual totals/sorting/pagination on DB result sets. Use instead:
- `selectRaw()` for calculations, aggregates, derived columns, window functions
- `SUM()`, `groupBy()`, `having()` for aggregation
- `orderBy()` / `orderByDesc()` for sorting
- `paginate($request->per_page ?? 15)` for pagination
- `orderBy($request->sort_by ?? users.name, $request->sort_order?? users.id)` if not present then use `desc`
- **Exception:** `map()` is allowed only to transform search-engine (e.g. Elasticsearch) results, never as a substitute for SQL processing.

## 4. Conditionals
- No nested `if/elseif/else` for query logic — use `when()`.
- Multiple request-value aliases for the same business type → `switch`, with shared `case` blocks for aliases:
  ```php
  case 'cashpayment':
  case 'cash-payment':
  case 'CPV':
      $q->where(fn ($sub) => $sub->where('transaction_types.prefix', 'CPV')
          ->orWhere('transactions.number_prefix', 'CPV'));
      break;
  ```
- Derived/display values (status, approval, debit/credit side, aging bucket, etc.) → SQL `CASE WHEN` inside `selectRaw()`, never PHP `if/elseif` after `get()`.
- Plain `if/else` remains fine for non-query concerns: auth checks, validation, transactions (`DB::transaction`), error handling — logic that can't live in the query layer.

## 5. Relationships & N+1
- No query inside a loop.
- Prefer `leftJoin()`/`leftJoinSub()` over eager-loading large relationship trees for reporting.
- Recursive relationships allowed **only** for genuine tree structures (e.g. Chart of Accounts hierarchy). Never for CRUD/reporting/listing/filtering.

## 6. Variables
Don't create a variable just to hold a single-use request value (`$tenantId`, `$from`, `$to`). Inline it. Variables are fine when reused multiple times or holding real computed data.

## 7. Response Contract
Don't change existing response keys, pagination shape, status codes, or frontend-consumed fields unless the task explicitly requires it.

## 8. Selects
Use `->select([...])` with explicit columns over `select('*')` when practical.

## 9. Style
Readable, concise, consistent with existing architecture. No unnecessary abstractions/helper classes for a few lines of query code.

---

 `$request->tenant_id` used directly, no fallback
 No unnecessary single-use variables
 `when()` used for optional filters (value-callback form)
 Date filters use `whereDate()`
 Eloquent used, no `DB::table/query/raw`
 `leftJoin()`/`leftJoinSub()` used where appropriate
 `selectRaw()` + `CASE WHEN` for calculated/derived values
 Filtering, sorting, aggregation all done in SQL
 Window functions used for running balances/reporting where useful
 Pagination via `paginate()`
 No N+1, no query-in-loop
 No `foreach`/`map()`/collection processing on DB data (except search-result transforms)
 Recursive relationships only for real hierarchies (e.g. COA)
 Existing API response contract preserved





 ### 34. Datatable Headers as Single Source of Truth for Sorting

For every index/datatable, define the sortable database column directly in the `headers()` configuration using the `name` property.

Example:

```php
[
    "title" => "Voucher Date",
    "name" => "transactions.transaction_date",
    "value" => "voucher_date",
    "type" => "date",
    "sortable" => true,
]
```

The `name` property is the **single source of truth** for frontend/backend sorting.

When the frontend sends a sort request, it should use the `name` value directly:

```text
transactions.transaction_date
```

Do **not** create unnecessary PHP arrays, `map()` logic, `switch` statements, or manual column mappings just to convert frontend sort fields into database columns when the correct database column is already defined in `headers()`.

#### Rules

* `headers()['name']` defines the actual database column used for sorting.
* `sortable => true` determines whether the column can be sorted.
* Frontend sorting should pass the header's `name` directly.
* Backend should validate the requested sort column against the defined headers before applying `orderBy()`.
* Do not duplicate the same column mapping in another array or method.
* Do not use `map()` only to transform sorting columns.
* Do not create unnecessary variables for sorting-column conversion.
* Use the existing header configuration as the centralized sorting definition.

Example backend usage:

```php
->when($request->sort_by, function ($q, $sortBy) {
    $q->orderBy($sortBy, $request->sort_direction ?? 'asc');
})
```

The implementation should ensure that `$sortBy` is an allowed value from the datatable headers before applying it to the query.

### Sorting Configuration Principle

**Define the database column once in `headers()` and reuse it everywhere.**

```text
headers()
   ↓
name = transactions.transaction_date
   ↓
Frontend sends sort_by
   ↓
Backend validates allowed header names
   ↓
orderBy(sort_by, direction)
```

Avoid:

```php
$sortColumns = [
    'voucher_date' => 'transactions.transaction_date',
    'amount' => 'transactions.total_amount',
    'status' => 'transaction_statuses.name',
];
```

when the same information already exists in `headers()`.

The header configuration should remain the **single source of truth** for datatable column definitions, including sorting.



For the counter, please don’t use:

`$this->nextCounter(strtolower($typePrefix), $request->tenant_id);`

Just use the `$typePrefix` directly without `strtolower()`, like this:

`$this->nextCounter($typePrefix, $request->tenant_id);`

Please don’t use `strtolower()` for the counter.





 Please remove the unnecessary `in_array()` validation and the extra `$sortableColumns` variable.
 There is no need to define additional variables for `sort_by` and `sort_direction` when the request values can be used directly.
 Keep the sorting logic simple and consistent with the existing code structure.
 Use the following implementation:

```php
$data = $this->BuildBaseQuery($request)
    ->orderBy(
        $request->sort_by ?? $headers->column(2)->name,
        $request->sort_direction ?? 'desc'
    )
    ->paginate($request->per_page ?? 15);
```

* The default sorting column should come directly from `$headers->column(2)->name`.
* The default sorting direction should be `desc`.
* Avoid adding unnecessary validation or variables unless they are actually required.