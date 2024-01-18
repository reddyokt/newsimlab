<!DOCTYPE html>
<html lang="en">
<!-- divinectorweb.com -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Resume website html css</title>
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 300px;
            /* Should be removed. Only for demonstration */
        }

        .columnd {
            width: 100%;
            padding: 10px;
            height: 300px;
            /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .header {
            text-align: center;
            color: #1bb974
        }

        .header h1 {
            margin-bottom: 5px;
        }

        .img-area {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 5px auto;
            border: 15px groove #1bb974;
        }

        .img-area img {
            width: 100%;
        }

        .left p {
            line-height: 0.5;
        }

        .left ul li {
            line-height: 1;
        }

        h2 {
            background: #1bb974;
            padding: 5px;
            color: #fff;
            margin: 30px 0;
            font-size: 20px;
            border-radius: 0 10px 50px 0;
        }

        table {
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em solid #ccc;
            border-bottom: 0;
            border-collapse: collapse;
            width: 100%;
        }

        table td,
        table th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 50px;
        }
    </style>
</head>

<body>

    @foreach ($kaderindex as $kader)
        <div class="img-area">
            <img src="{{ public_path('/upload/kader/profile_picture/') . $kader->pp }}" alt="">
        </div>
        <div class="header">
            <h1>{{ $kader->kader_name }}</h1>
        </div>

        <div class="row" style="margin-bottom: 50px;">
            <div class="column" style="background-color:#white;">
                <div class="left">
                    <h2>Data Pribadi</h2>
                    <p><strong>Nama: </strong>{{ $kader->kader_name }}</p>
                    <p><strong>Email: </strong>{{ $kader->kader_email }}</p>
                    <p><strong>Gender: </strong>{{ $kader->gender }}</p>
                    <p><strong>Marital Status: </strong>{{ $kader->marital }}</p>
                    <p><strong>Anak: </strong>{{ $kader->anak }}</p>
                    <p><strong>Pekerjaan: </strong>{{ $kader->nama_pekerjaan }}</p>

                    <h2>Data Keanggotaan</h2>
                    <p><strong>Ranting: </strong>{{ $kader->ranting_name }}</p>
                    <p><strong>NBM: </strong>{{ $kader->nbm }}</p>
                    <p><strong>NBA: </strong>{{ $kader->nba }}</p>
                </div>
            </div>
    @endforeach
    <div class="column" style="background-color:#white;">
        <div class="right">
            <h2>Riwayat Pendidikan</h2>
            @foreach ($kader_edu as $edu)
                <p><strong>{{ $edu->jenjang }}</strong>, Tahun Lulus :{{ $edu->eduyear }}</p>
            @endforeach

            <h2>Riwayat Pelatihan</h2>
            @foreach ($kader_training as $training)
                <p><strong>{{ $training->trainingtype }}:</strong> {{ $training->trainingname }}</p>
            @endforeach
        </div>
    </div>
    </div>
    <div class="row">
        <div class="columnd">
            <h2 class="1">Riwayat Organisasi Internal</h2>
            <table>
                <tr>
                    <th style="width: 20%">Tingkat Organisasi</th>
                    <th style="width: 40%">Jabatan</th>
                    <th>Periode</th>
                </tr>
                @foreach ($kader_orgint as $orgint)
                    <tr style="text-align: center">
                        <td> {{ $orgint->orggrade }}</td>
                        <td> {{ $orgint->orgintjabatan }}</td>
                        <td> {{ $orgint->orgintstart }} ~ {{ $orgint->orgintend }}</td>
                    </tr>
                @endforeach

            </table>
            <h2 class="1">Riwayat Organisasi Eksternal</h2>
            <table>
                <tr>
                    <th style="width: 20%">Nama Organisasi</th>
                    <th style="width: 40%">Jabatan</th>
                    <th>Periode</th>
                </tr>
                @foreach ($kader_orgext as $orgext)
                    <tr style="text-align: center">
                        <td> {{ $orgext->orgextname }}</td>
                        <td> {{ $orgext->orgextjabatan }}</td>
                        <td> {{ $orgext->orgextstart }} ~ {{ $orgext->orgextend }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <footer>
        <p style="color: grey;">data-diambil-pada-{{$date->format('l,jFY;h:i')}}</p>
    </footer>
</body>

</html>
