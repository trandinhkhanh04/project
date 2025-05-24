<?php

class revenueModel extends CI_Model
{
    public function getTodayRevenue()
    {
        $sql = "
            SELECT 
                SUM(TotalAmount) AS TotalRevenueToday
            FROM 
                orders
            WHERE 
                DATE(Payment_date_successful) = CURDATE()
        ";
        $query = $this->db->query($sql);
        return $query->row()->TotalRevenueToday ?? 0;

        
    }

    // Tính tổng lợi nhuận của ngày hôm nay
    public function getTodayProfit()
    {
        $sql = "
            SELECT 
                SUM(o.TotalAmount) AS Total_Revenue,
                SUM(ob.quantity * b.Import_price) AS Total_Cost,
                SUM(od.Quantity * od.Selling_price) - SUM(ob.quantity * b.Import_price) AS Total_Profit
            FROM orders o
            JOIN order_detail od ON o.Order_Code = od.Order_Code
            JOIN order_batches ob ON od.id = ob.order_detail_id
            JOIN batches b ON ob.batch_id = b.Batch_ID
            WHERE o.Payment_Status = 1
            AND DATE(o.Payment_date_successful) = CURDATE()
        ";
        $query = $this->db->query($sql);
        return $query->row()->Total_Profit ?? 0;
    }


    // Tính tổng số đơn hàng mới của ngày hôm nay
    public function getTodayNewOrders()
    {
        $sql = "
            SELECT 
                COUNT(*) AS Total_New_Orders
            FROM 
                orders
            WHERE 
                Order_Status = -1
               
        ";
        $query = $this->db->query($sql);
        return $query->row()->Total_New_Orders ?? 0;
    }

    // Tính tổng số người dùng mới của ngày hôm nay
    public function getTodayNewUsers()
    {
        $sql = "
            SELECT 
                COUNT(*) AS Total_New_Users
            FROM 
                users
            WHERE 
                DATE(Date_created) = CURDATE() AND Role_ID = '2' AND Status = '1'
        ";
        $query = $this->db->query($sql);
        return $query->row()->Total_New_Users ?? 0;
    }


    private function calculateProfitTotals($orderProfits, $groupByFormat)
    {
        $totalProfitAll = 0;
        $totalRevenueAll = 0;
        $totalCostAll = 0;
        $groupedTotals = [];

        foreach ($orderProfits as $order) {
            $groupKey = date($groupByFormat, strtotime($order->Payment_Date));
            $totalProfitAll += $order->Total_Profit;
            $totalRevenueAll += $order->Total_Revenue;
            $totalCostAll += $order->Total_Cost;

            if (!isset($groupedTotals[$groupKey])) {
                $groupedTotals[$groupKey] = [
                    'Total_Revenue' => 0,
                    'Total_Cost' => 0,
                    'Total_Profit' => 0
                ];
            }

            $groupedTotals[$groupKey]['Total_Revenue'] += $order->Total_Revenue;
            $groupedTotals[$groupKey]['Total_Cost'] += $order->Total_Cost;
            $groupedTotals[$groupKey]['Total_Profit'] += $order->Total_Profit;
        }

        return [
            'totalProfitAll' => $totalProfitAll,
            'totalRevenueAll' => $totalRevenueAll,
            'totalCostAll' => $totalCostAll,
            'groupedTotals' => $groupedTotals
        ];
    }

    public function getProfitByDateRange($startDate, $endDate)
    {
        if (strlen($startDate) === 10) {
            $startDate .= ' 00:00:00';
        }
        if (strlen($endDate) === 10) {
            $endDate .= ' 23:59:59';
        }

        $sql = "
            SELECT 
                DATE(o.Payment_date_successful) AS Payment_Date,
                od.Order_Code,
                CASE 
                    WHEN o.DiscountID IS NOT NULL THEN o.TotalAmount 
                    ELSE SUM(od.Quantity * od.Selling_price) 
                END AS Total_Revenue,
                SUM(ob.quantity * b.Import_price) AS Total_Cost,
                CASE 
                    WHEN o.DiscountID IS NOT NULL THEN o.TotalAmount 
                    ELSE SUM(od.Quantity * od.Selling_price) 
                END - SUM(ob.quantity * b.Import_price) AS Total_Profit
            FROM orders o
            JOIN order_detail od ON o.Order_Code = od.Order_Code
            JOIN order_batches ob ON od.id = ob.order_detail_id
            JOIN batches b ON ob.batch_id = b.Batch_ID
            WHERE o.Payment_Status = 1
            AND o.Payment_date_successful BETWEEN ? AND ?
            GROUP BY DATE(o.Payment_date_successful), od.Order_Code
            ORDER BY Payment_Date ASC, od.Order_Code ASC
        ";

        $query = $this->db->query($sql, [$startDate, $endDate]);
        if (!$query) {
            return [
                'error' => 'Database query failed',
                'orderProfits' => [],
                'dailyTotals' => [],
                'totalProfitAll' => 0,
                'totalRevenueAll' => 0,
                'totalCostAll' => 0
            ];
        }

        $orderProfits = $query->result();
        $totals = $this->calculateProfitTotals($orderProfits, 'Y-m-d');

        return [
            'orderProfits' => $orderProfits,
            'dailyTotals' => $totals['groupedTotals'],
            'totalProfitAll' => $totals['totalProfitAll'],
            'totalRevenueAll' => $totals['totalRevenueAll'],
            'totalCostAll' => $totals['totalCostAll']
        ];
    }

    public function getProfitByMonthRange($startMonth, $endMonth)
    {
        if (empty($startMonth) || empty($endMonth)) {
            return [
                'error' => 'Invalid date range',
                'orderProfits' => [],
                'monthlyTotals' => [],
                'totalProfitAll' => 0,
                'totalRevenueAll' => 0,
                'totalCostAll' => 0
            ];
        }

        $startDate = $startMonth . '-01 00:00:00';
        $endDate = date("Y-m-t 23:59:59", strtotime($endMonth . '-01'));

        $sql = "
            SELECT 
                DATE(o.Payment_date_successful) AS Payment_Date,
                od.Order_Code,
                CASE 
                    WHEN o.DiscountID IS NOT NULL THEN o.TotalAmount 
                    ELSE SUM(od.Quantity * od.Selling_price) 
                END AS Total_Revenue,
                SUM(ob.quantity * b.Import_price) AS Total_Cost,
                CASE 
                    WHEN o.DiscountID IS NOT NULL THEN o.TotalAmount 
                    ELSE SUM(od.Quantity * od.Selling_price) 
                END - SUM(ob.quantity * b.Import_price) AS Total_Profit
            FROM orders o
            JOIN order_detail od ON o.Order_Code = od.Order_Code
            JOIN order_batches ob ON od.id = ob.order_detail_id
            JOIN batches b ON ob.batch_id = b.Batch_ID
            WHERE o.Payment_Status = 1
            AND o.Payment_date_successful BETWEEN ? AND ?
            GROUP BY DATE(o.Payment_date_successful), od.Order_Code
            ORDER BY Payment_Date ASC, od.Order_Code ASC
        ";

        $query = $this->db->query($sql, [$startDate, $endDate]);
        if (!$query) {
            return [
                'error' => 'Database query failed',
                'orderProfits' => [],
                'monthlyTotals' => [],
                'totalProfitAll' => 0,
                'totalRevenueAll' => 0,
                'totalCostAll' => 0
            ];
        }

        $orderProfits = $query->result();
        $totals = $this->calculateProfitTotals($orderProfits, 'Y-m');

        return [
            'orderProfits' => $orderProfits,
            'monthlyTotals' => $totals['groupedTotals'],
            'totalProfitAll' => $totals['totalProfitAll'],
            'totalRevenueAll' => $totals['totalRevenueAll'],
            'totalCostAll' => $totals['totalCostAll']
        ];
    }

    public function getProfitByYearRange($startYear, $endYear)
    {
        $startDate = $startYear . '-01-01 00:00:00';
        $endDate = $endYear . '-12-31 23:59:59';

        $sql = "
            SELECT 
                DATE(o.Payment_date_successful) AS Payment_Date,
                od.Order_Code,
                CASE 
                    WHEN o.DiscountID IS NOT NULL THEN o.TotalAmount 
                    ELSE SUM(od.Quantity * od.Selling_price) 
                END AS Total_Revenue,
                SUM(ob.quantity * b.Import_price) AS Total_Cost,
                CASE 
                    WHEN o.DiscountID IS NOT NULL THEN o.TotalAmount 
                    ELSE SUM(od.Quantity * od.Selling_price) 
                END - SUM(ob.quantity * b.Import_price) AS Total_Profit
            FROM orders o
            JOIN order_detail od ON o.Order_Code = od.Order_Code
            JOIN order_batches ob ON od.id = ob.order_detail_id
            JOIN batches b ON ob.batch_id = b.Batch_ID
            WHERE o.Payment_Status = 1
            AND o.Payment_date_successful BETWEEN ? AND ?
            GROUP BY DATE(o.Payment_date_successful), od.Order_Code
            ORDER BY Payment_Date ASC, od.Order_Code ASC
        ";

        $query = $this->db->query($sql, [$startDate, $endDate]);
        if (!$query) {
            return [
                'error' => 'Database query failed',
                'orderProfits' => [],
                'yearlyTotals' => [],
                'totalProfitAll' => 0,
                'totalRevenueAll' => 0,
                'totalCostAll' => 0
            ];
        }

        $orderProfits = $query->result();
        $totals = $this->calculateProfitTotals($orderProfits, 'Y');

        return [
            'orderProfits' => $orderProfits,
            'yearlyTotals' => $totals['groupedTotals'],
            'totalProfitAll' => $totals['totalProfitAll'],
            'totalRevenueAll' => $totals['totalRevenueAll'],
            'totalCostAll' => $totals['totalCostAll']
        ];
    }


    public function getBatchProfitStatus()
    {
        $sql = "
    SELECT 
        b.Batch_ID,
        b.ProductID,
        p.Name AS Product_Name,
        p.Product_Code AS Product_Code,
        b.Import_date,
        b.Import_price,
        b.Quantity AS Total_Quantity,
        (b.Quantity * b.Import_price) AS Total_Cost,
        IFNULL(SUM(CASE WHEN o.Order_Status = 4 AND o.Payment_Status = 1 THEN ob.quantity ELSE 0 END), 0) AS Total_Sold,
        IFNULL(SUM(CASE WHEN o.Order_Status = 4 AND o.Payment_Status = 1 THEN (ob.quantity * od.Selling_price - IFNULL(od.discount_amount, 0)) ELSE 0 END), 0) AS Total_Revenue,
        (b.Quantity * b.Import_price) - 
        IFNULL(SUM(CASE WHEN o.Order_Status = 4 AND o.Payment_Status = 1 THEN (ob.quantity * od.Selling_price - IFNULL(od.discount_amount, 0)) ELSE 0 END), 0) AS Remaining_Amount
    FROM batches b
    LEFT JOIN product p ON b.ProductID = p.ProductID
    LEFT JOIN order_batches ob ON b.Batch_ID = ob.batch_id
    LEFT JOIN order_detail od ON ob.order_detail_id = od.id
    LEFT JOIN orders o ON od.Order_Code = o.Order_Code
    GROUP BY b.Batch_ID, b.ProductID, p.Name, p.Product_Code, b.Import_date, b.Import_price, b.Quantity;
    ";

        $query = $this->db->query($sql);
        $result = $query->result();

        $groupedData = [];
        foreach ($result as $row) {
            $productID = $row->ProductID;

            if (!isset($groupedData[$productID])) {
                $groupedData[$productID] = [
                    'ProductID' => $row->ProductID,
                    'Product_Name' => $row->Product_Name,
                    'Product_Code' => $row->Product_Code,
                    'Batches' => []
                ];
            }

            $groupedData[$productID]['Batches'][] = [
                'Batch_ID' => $row->Batch_ID,
                'Import_date' => $row->Import_date,
                'Import_price' => $row->Import_price,
                'Total_Quantity' => $row->Total_Quantity,
                'Total_Cost' => $row->Total_Cost,
                'Total_Sold' => $row->Total_Sold,
                'Total_Revenue' => $row->Total_Revenue,
                'Remaining_Amount' => $row->Remaining_Amount
            ];
        }

        return array_values($groupedData);
    }
}
