<script src="<?=base_url();?>assets/js/jquery-3.1.1.min.js"  crossorigin="anonymous"></script>
<script src="<?php echo base_url();?>jsPDF/dist/jspdf.debug.js"></script>
<script src="<?php echo base_url();?>jsPDF/html2canvas.js"></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<?php //echo "<pre>".var_dump($data)."<pre>"; ?>

<style>
    #toPDF{
        margin: auto;
        background-color: white;
    }

    #planning {
        margin: auto;
        font-size: 18px;
        font-family: 'Open Sans',sans-serif;
    }
    table {
        empty-cells: hide;
    }
    #planning th {
        padding-left:40px ;
        padding-right:40px ;
    }
    table td {
        border:2px solid gray;
        text-align: center;
    }
    .prof1 {
        background-color: #2ecc71;
        float: left;
        width: 50%;
        font-weight: bold;
    }
    .prof2 {
        background-color: #3498db;
        float: right;
        width: 50%;
        font-weight: bold;
    }
    .info_soutenance{
        border:2px solid black;
        height:44px;
        padding-bottom: 4px;
    }
    #salle_td div:last-child {
        border-bottom:none;
    }
    .td_soutenance {
        border:none;
    }

    .salle {
        padding-top: 12px;
        padding-bottom: 12px;
        height:24px;
        border-bottom: solid 1px black;
    }

    #prof_pdf {
        background-color: white;
        font-family: 'Open Sans',sans-serif;
    }
    #prof td {
        border: none;
    }
    #prof {
        font-size: 35px;
        margin-left: auto;
        margin-right: auto;
        padding-top:200px!important;
    }

</style>
<body>
<div id="toPDF">

    <h1 style="text-align: center;padding-top: 100px;">PLANNING SOUTENANCES</h1>

    <table id="planning">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <?php foreach($date as $day){
                setlocale (LC_TIME, 'fr_FR.utf8','fra');
                echo "<th>".strftime("%A %d/%m",strtotime($day))."</th>";
            }?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($horaire as $hor){ ?>
            <tr>
                <td class="horaire"><?php echo $hor; ?></td>
                <td id="salle_td">
                    <?php foreach($salle_horaire[$hor] as $salle){
                        echo "<div class='salle'>salle ".$salle."</div>";
                    } ?>
                </td>
                <?php foreach ($date as $day){
                    echo "<td class='td_soutenance'>";
                    foreach($salle_horaire[$hor] as $salle) {
                        $find = false;
                        foreach ($data as $soutenance) {
                            if ($soutenance->date == $day && ($soutenance->horaire == $hor || "0" . $soutenance->horaire == $hor) && $soutenance->id_salle ==$salle) {
                                echo "<div class='info_soutenance'><div><div class='prof1'>" . $soutenance->prof1 . "</div>
                                   <div class='prof2'>" . $soutenance->prof2 . "</div></div>
                                   <div>" . $soutenance->id_etudiant . "</div></div>";
                                $find=true;
                            }
                        }
                        if ($find == false){
                            echo "<div class='info_soutenance' style='border:solid 1px black;'><div><div class='prof1'></div>
                                   <div class='prof2'></div></div>
                                   <div></div></div>";
                        }
                    }
                    echo "</td>";
                }?>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<div id="prof_pdf">
    <table id="prof">
        <thead>
        <tr>
            <th>Abréviation</th><th>Nom</th><th>Prenom</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($prof as $p){?>
            <tr>
                <td><?php echo $p[0]; ?></td>
                <td><?php echo $p[1]; ?></td>
                <td><?php echo $p[2]; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>




<script>
    var pdf = new jsPDF('p', 'pt', 'a4');
    pdf.addHTML($('#toPDF')[0], function () {

        pdf.addPage();
//        window.location.href = "<?php //echo base_url() ?>//index.php/C_admin";
    });
    pdf.addHTML($('#prof_pdf')[0],function(){
        pdf.save('Planning.pdf');
    });
</script>


</body>

