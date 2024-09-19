<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <title>Accounts Report</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        /* Basic styling for the PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #007BFF;
        }

        .header p {
            margin: 0;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Add more styling as needed */
    </style>
</head>
<body>
    <div class="header">
        <h2>Softech Microfinance</h2>
        <p>Accounts Report</p>
    </div>
<div class="page-break">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client ID</th>
                <th>Account Number</th>
                <th>Account Type</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($accounts  as $account)
              @if(is_array($account))
                <tr>
                    <td>{{ $account['id']}}</td>
                    <td>{{ $account['client_id'] }}</td>
                    <td>{{ $account['account_number'] }}</td>
                    <td>{{ $account['account_type'] }}</td>
                    <td>{{ $account['balance'] }}</td>
                </tr>
                @endif
            @endforeach --}}

            <p>hello</p>
        </tbody>
    </table>
</div>
</body>
</html>
