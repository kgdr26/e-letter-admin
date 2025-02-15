<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash In Advance PDF</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10mm;
        }


        .container {
            width: 98%;
            border: 1px solid black;
            padding: 10px;
            box-sizing: border-box;
            page-break-inside: avoid;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            gap: 0;
        }

        /* .header-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
        } */

        .header-logo {
            position: absolute;
            top: 5rem;
            left: 3rem;
            z-index: 9999;
            width: 80px;
            height: auto;
        }

        .header-logo2 {
            position: absolute;
            top: 32rem;
            left: 3rem;
            z-index: 9999;
            width: 80px;
            height: auto;
        }

        .header-title {
            flex: 1;
            text-align: center;
            margin: 0;
        }

        /* img {
            width: 120%;
        } */

        .header-title h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .header-title h4 {
            margin: 5px 0 0 0;
            font-weight: normal;
        }

        .status-box {
            width: 100px;
            height: 40px;
            border: 1px solid black;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: red;
            font-size: 10px;
            margin-left: auto;
            flex-shrink: 0;
        }

        table {
            width: 100%;
            margin: 15px 0;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 3px 5px;
            border: none;
            text-align: left;
            line-height: 1.3;
            font-size: 12px;
        }

        .form-label {
            width: 100px;
            font-weight: bold;
        }

        .approved-section {
            width: 100%;
            text-align: center;
            margin: 10px;
            padding: 10px;
            font-weight: bold;
        }

        .approved-section div {
            display: inline-block;
            width: 20%;
            vertical-align: top;
            padding: 0 45px;
            box-sizing: border-box;
            font-size: 12px;
        }

        .approved-section p {
            margin: 5px 5px;
        }

        .approved-section .username {
            border-top: 1px solid black;
            padding-top: 5px;
            font-size: 10px;
        }

        hr {
            border: none;
            border-top: 2px solid black;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-logo">
                <img src="{{ public_path('assets/img/LogoStar_1.png') }}" alt="Logo"
                    style="width: 100px; height: auto;">
            </div>
            <div class="header-title">
                <h2>PT. ASTRA DAIDO STEEL INDONESIA</h2>
                <h4>Cash In Advance || Finance Dept</h4>
            </div>
            <div class="status-box">
                <p>
                    @switch($cia->status)
                        @case(1)
                            Draft
                        @break

                        @case(2)
                            <button class="btn btn-primary btn-sm">Dept-Approve</button>
                        @break

                        @case(3)
                            <button class="btn btn-primary btn-sm">Fin-Approve</button>
                        @break

                        @default
                            <button class="btn btn-primary btn-sm">Unknown</button>
                    @endswitch
                </p>
            </div>
        </div>
        <hr>
        <table>
            <tr>
                <th class="form-label">Date On</th>
                <td>: {{ $cia->date_create }}</td>
            </tr>
            <tr>
                <th class="form-label">PIC</th>
                <td>: {{ $cia->user_name }}</td>
            </tr>
            <tr>
                <th class="form-label">Necessity</th>
                <td>: {{ $cia->necessity }}</td>
            </tr>
            <tr>
                <th class="form-label">Amount</th>
                <td>: Rp {{ number_format($cia->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th class="form-label">Qty</th>
                <td>: {{ $cia->qty }} {{ $cia->unit }}</td>
        </table>
        <hr>
        <div class="approved-section">
            <!-- Approval Requester -->
            <div>
                <p>App. Requester</p>
                <p>
                    <button class="btn btn-primary btn-sm">Submitted</button>
                </p>
                <p class="username">{{ $cia->user_name }}</p>
            </div>

            <!-- Approval Dephead -->
            <div>
                <p>App. Dephead</p>
                <p>
                    @if ($cia->status >= 2)
                        <!-- Cetak tanda tangan jika sudah disetujui Dephead -->
                        <button class="btn btn-primary btn-sm">Dept-Approve</button>
                    @else
                        <button class="btn btn-light btn-sm">Waiting Approval</button>
                    @endif
                </p>
                <p class="username">{{ $cia->dephead_name ?? '-' }}</p> <!-- Nama Dephead -->
            </div>

            <!-- Approval Finance -->
            <div>
                <p>App. Fin Dept</p>
                <p>
                    @if ($cia->status >= 3)
                        <!-- Cetak tanda tangan jika sudah disetujui Finance -->
                        <button class="btn btn-primary btn-sm">Fin-Approve</button>
                    @else
                        <button class="btn btn-light btn-sm">Waiting Approval</button>
                    @endif
                </p>
                <p class="username">{{ $cia->finance_name ?? '-' }}</p> <!-- Nama Finance -->
            </div>
        </div>
    </div>

    {{-- || ---------------------------------------------------------------------------------------------------------- || --}}
    <br><br>
    <div class="container">
        <div class="header">
            <div class="header-logo">
                <img src="{{ public_path('assets/img/LogoStar_1.png') }}" alt="Logo"
                    style="width: 100px; height: auto;">
            </div>
            <div class="header-title">
                <h2>PT. ASTRA DAIDO STEEL INDONESIA</h2>
                <h4>Cash In Advance || Finance Dept</h4>
            </div>
            <div class="status-box">
                <p>
                    @switch($cia->status)
                        @case(1)
                            Draft
                        @break

                        @case(2)
                            <button class="btn btn-primary btn-sm">Dept-Approve</button>
                        @break

                        @case(3)
                            <button class="btn btn-primary btn-sm">Fin-Approve</button>
                        @break

                        @default
                            <button class="btn btn-primary btn-sm">Unknown</button>
                    @endswitch
                </p>
            </div>
        </div>
        <hr>
        <table>
            <tr>
                <th class="form-label">Date On</th>
                <td>: {{ $cia->date_create }}</td>
            </tr>
            <tr>
                <th class="form-label">PIC</th>
                <td>: {{ $cia->user_name }}</td>
            </tr>
            <tr>
                <th class="form-label">Necessity</th>
                <td>: {{ $cia->necessity }}</td>
            </tr>
            <tr>
                <th class="form-label">Amount</th>
                <td>: Rp {{ number_format($cia->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th class="form-label">Qty</th>
                <td>: {{ $cia->qty }} {{ $cia->unit }}</td>
        </table>
        <hr>
        <div class="approved-section">
            <!-- Approval Requester -->
            <div>
                <p>App. Requester</p>
                <p>
                    <button class="btn btn-primary btn-sm">Submitted</button>
                </p>
                <p class="username">{{ $cia->user_name }}</p>
            </div>

            <!-- Approval Dephead -->
            <div>
                <p>App. Dephead</p>
                <p>
                    @if ($cia->status >= 2)
                        <!-- Cetak tanda tangan jika sudah disetujui Dephead -->
                        <button class="btn btn-primary btn-sm">Dept-Approve</button>
                    @else
                        <button class="btn btn-light btn-sm">Waiting Approval</button>
                    @endif
                </p>
                <p class="username">{{ $cia->dephead_name ?? '-' }}</p> <!-- Nama Dephead -->
            </div>

            <!-- Approval Finance -->
            <div>
                <p>App. Fin Dept</p>
                <p>
                    @if ($cia->status >= 3)
                        <!-- Cetak tanda tangan jika sudah disetujui Finance -->
                        <button class="btn btn-primary btn-sm">Fin-Approve</button>
                    @else
                        <button class="btn btn-light btn-sm">Waiting Approval</button>
                    @endif
                </p>
                <p class="username">{{ $cia->finance_name ?? '-' }}</p> <!-- Nama Finance -->
            </div>
        </div>
    </div>
</body>

</html>
