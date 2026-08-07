+---------------+
|     users     |
+---------------+
| id            |
| name          |
| email         |
| password      |
| role          |
+---------------+
        |
        | 1
        |
        | many
        |
+----------------------+
| stock_transactions   |
+----------------------+
| id                   |
| user_id              |
| product_id           |
| type                 |
| quantity             |
| description          |
| created_at           |
+----------------------+
        |
        | many
        |
        | 1
        |
+---------------+
|   products    |
+---------------+
| id            |
| category_id   |
| name          |
| sku           |
| price         |
| stock         |
| condition     |
| location      |
| description   |
| image         |
+---------------+
        |
        | many
        |
        | 1
        |
+----------------+
|   categories   |
+----------------+
| id             |
| name           |
| description    |
+----------------+

# 1. Users
id
name
email
password
role
created_at
updated_at

# 2. Categories
id
name
description

# 3. Products
id
category_id
name
sku
price
stock
condition
location
description
image

# 4. Stock Transactions
id
product_id
user_id
type
quantity
description
created_at

