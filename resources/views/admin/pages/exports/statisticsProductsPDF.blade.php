<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thống kê sản phẩm</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        h1, h2 {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
</head>
<body>
    <h1>Thống kê sản phẩm</h1>
    
    <h2>Tổng quan</h2>
    <p>Tổng số sản phẩm: {{ $statistics['total_products'] }}</p>
    <p>Sản phẩm còn hàng: {{ $statistics['total_active_products'] }}</p>
    <p>Sản phẩm hết hàng: {{ $statistics['total_out_of_stock'] }}</p>

    <h2>Sản phẩm theo danh mục</h2>
    <table>
        <thead>
            <tr>
                <th>Tên danh mục</th>
                <th>Số lượng sản phẩm</th>
                <th>Tổng số lượng tồn</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statistics['product_by_category'] as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->total_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Sản phẩm theo thương hiệu</h2>
    <table>
        <thead>
            <tr>
                <th>Tên thương hiệu</th>
                <th>Số lượng sản phẩm</th>
                <th>Tổng số lượng tồn</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statistics['product_by_brand'] as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->products_count }}</td>
                    <td>{{ $brand->total_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Top 10 sản phẩm bán chạy</h2>
    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng bán</th>
                <th>Doanh thu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statistics['top_selling_products'] as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->total_quantity }}</td>
                    <td>{{ number_format($item->total_revenue, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>