# wms

--Fix orders implode explode manipulation for items
--Fix Prepared statement
--Fix Transaction commit and rollback
--Products difference in customer and
--Stock Trigger when tock about to finish
--Fix delete and Update verification
--Before sales check if the quantity available is enough 
--Fix CHECK Constrains on Tables
--FIX after_transfer_insert trigger
--Print to PDF and Export into excel
--Fix 3 tables join

# Order
--Automate Request based on average days it takes a product to finish 
(e.g If Banana takes 1 week to finish send request 1 week before stock is 0)

--Error handling should be properly done with arrays

# Warehouse
-- Implement avarage selling time of a product (Used to place order before it finishes)
-- Product summary (Ins and Outs)

# Sales

-- Sales form should shave product selection tool name, barcode (When chosen it display product information)

-- The customer it\s comining in the shop, Customer Choose items, payout

-- Chooses collects customer items scans the items and enter details to generate receipt and sales invoice
-- View order on b2b home.php should 

-- Sales should not happen without items in stock from the sql query

--Every User Transaction should keep a log/History in the log table

--On b2b_admin.php orders should be from the modules not hardcoded as I did now, just call the get_order function from Orders class

--Damages Shouldn't record without items from stock
-- Need to fix Stock Rack column and Product Rack column conflict (Remove Expiry date on product and put it on Stock, also remove rack from Product)


--Seperate all the PHP code with the html pages (Logout logics handled on auth, File URLs should)
-- Fix on Select item fetch its corresponding from database (E.g While adding Stock Select warehouse to fetch all racks under that warehouse)
--fix creation of double rack with same address (Every Rack is Unique)
-- Generate User Profile Menu's Automatic using role, page and some session data

ALTER TABLE `users`
  ADD UNIQUE KEY `phone` (`phone`);


Seles fromat =>products:rice,beans;quantity:10,20;prices:20,25;unit_measure:kg,bag;product_ids:5,5; rack_ids:1,2
Can I have two or more sales with same order_id?

Request from warehouse to admin Format => products:rice,beans;quantity:10,20;unit_measure:kg,bag;product_ids:5,5


Purchase from supplier =>products:banana,rice,beans;quantity:3,10,20;prices:2,20,25;unit_measure:pieces,kg,bag;product_ids:1,5,5

Review Product_discounts table and Products Table

1. Who make Purchase? Admin or Warehouse? Is Warehouse specified in Purchase?
2. Is there an invoice of purchase?