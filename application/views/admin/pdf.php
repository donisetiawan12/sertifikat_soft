<!DOCTYPE html>
<html lang="en"><head>
        <title>Document</title>
</head><body>
        <?php foreach($assignments as $pdf) : ?>
        <h1><?= $pdf->organizer ?></h1>
        <h1><?= $pdf->participant_name ?></h1>
        <h1><?= $pdf->certificate_text ?></h1>
        <h1><?= $pdf->username ?></h1>
        <h1><?= $pdf->location ?></h1>
        <h1><?= $pdf->event_date ?></h1>
        <?php endforeach ?>
</body></html>