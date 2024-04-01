SELECT user.user_name AS Name, user.user_city AS City, user.user_country AS Country,         
orders.order_date AS Date, orders.order_total AS 'Total do Pedido' FROM orders INNER JOIN user ON orders.order_user_id = user.user_id 
WHERE user.user_id IN (1, 3, 5) ORDER BY Name;

UPDATE user SET user_country = 'Canada' WHERE user_id = 4;

SELECT DATE_FORMAT(o.order_date, '%Y-%m') AS month_year,
       SUM(o.order_total) AS total_sales
FROM orders o
INNER JOIN user u ON o.order_user_id = u.user_id
WHERE u.user_id IN (1, 3, 5)
GROUP BY DATE_FORMAT(o.order_date, '%Y-%m')
ORDER BY DATE_FORMAT(o.order_date, '%Y-%m');
