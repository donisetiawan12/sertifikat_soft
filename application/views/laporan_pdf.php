<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Download</title>
</head><body>

<h1 style="text-align: center;">SERTIFIKAT PENGHARGAAN  </h1>
<hr style="width: 100%; ">
<hr style="width: 100%; ">
    <p style="text-align: center;">
    Jl. Arridho No. 166 Kp. Sawah RT. 01/04 Jatimulya – Cilodong – Depok 16413 Telp. (021) 87900425
    <br>
    Website: www.smkyajdepok.sch.id Email: smk_yajdepok@gmail.com
    </p>
    



    <h3 style="text-align: center;">Yang dilaksanakan oleh:</h3>
    <h1 style="text-align: center;"><?= $event->organizer ?></h1>
    <hr style="width: 55%; ">
    <h3 style="text-align: center;">Diberikan kepada :</h3>
    <h1 style="text-align: center;"><?= $sertifikat->participant_name ?></h1>
    <p style="text-align: center;"><?= $sertifikat->certificate_text ?></p>
    <hr style="width: 55%; ">
    <h1 style="text-align: center;"><?= $event->event_name?></h1>
    <hr style="width: 55%; ">
    <h3 style="text-align: center;">Lokasi :</h3>
    <h3 style="text-align: center;"><?= $event->location ?></h3>
    <p style="text-align: center;">Pada tanggal: <?= $event->event_date ?></p>

</body></html>