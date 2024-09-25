# pos-food-laravel

Food Point of Sales System.

## Scope

- Each restaurant client should access different data (SAAS).
- There are 3 types of client roles: Client admin, Client staff, Client attendance

## User Cases

- New client admin register his/her company on system
- Client user signs in on system
- Client staff adds menu items
- Client attendance adds new sell
  - Add all items to cart
  - Confirm the items on cart and go to payment
  - After payment, the sell status is ready to cook
- Client staff opens store
  - Page confirms all menu items available and theirs stock if it is enable
- Client staff closes store
  - Page confirms all sales of the day

## Pending Tasks

- Add company fields (ex: CNPJ) to Organization Model/migration :white_check_mark:
- Install Filament :white_check_mark:
- Add multi-tenancy rules :white_check_mark:
- Create Menu/MenuItem CRUD pages
- Update Register user page to create organization too
- Add Open/Close Store features
- Add attendance flow pages
- Add payment features
- Add stock features
- Add Client Admin reports
