-- IDENTIFY ALL VIEWS AND CREATE THEM HERE

--Products under each category

CREATE VIEW sales_report
AS 
SELECT product, description FROM sales INNER JOIN products ON sale_id=product_id


