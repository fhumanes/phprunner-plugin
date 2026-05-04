
// SQL query
$this->settings["sql"] = "select OrderID, sum(UnitPrice*Quantity) as Total from `order details` group by OrderID"; 

// label column name
$this->settings["xAxis"] = "OrderID"; 

// data column name
$this->settings["yAxis"] = "Total"; 

// chart type ( column, line, bar, bar3d, pie )
$this->settings["type"] = "column"; 

// title 
$this->settings["title"] = "Orders by customer";
