<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title><?=  $training->slug ?></title>
        <meta name="description" content="">

        <link href="css/pure.min.css" rel="stylesheet" media="screen">

    </head>

    <body>

      <div width="100%;">

      <div style="position:absolute; top: 10%;visibility:30%;left:15%;">
          Logo
      </div>

        <div style="padding:20px; text-align:center;">
              <div style="padding:20px; text-align:center;">
                     <span style="font-size:50px; font-weight:bold">Sertifikat</span>
                     <br><br>
                     <span style="font-size:25px"><i>Diberikan Kepada</i></span>
                     <br><br>
                     <span style="font-size:25px"><b>
                         <?= $user->full_name ?>
                     </b></span><br/><br/>
                     <span style="font-size:25px">
                        <i>Atas Peran Serta Sebagai</i>
                    </span> <br/><br/>
                     <span style="font-size:25px">PESERTA</span>
                     <br/><br/>
                     <span style="font-size:35px">
                        <b>
                            Pelatihan  : "<?= strtoupper($training->title) ?>"
                        </b>
                    </span>
                    <br/><br/><br/><br/>
                    <br/><br/><br/>
                     <span style="font-size:25px">
                        <i>Bandung, <?= carbon_format()->format('d M Y') ?></i><br>
                        Dir. Pusat Pengembangan Karir dan Pengelolaan Alumni
                     </span><br>

                    <div style="font-size:25px; position:relative;height:100px; ">
                        <div style="position:absolute;bottom:0;text-align:center;left:50%">
                            <?= $training->cdc_head_officer ?>
                        </div>
                    </div>
              </div>
        </div>
      </div>
    </body>

</html>
