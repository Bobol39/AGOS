
<script src="<?=base_url();?>assets/js/jquery-3.1.1.min.js"  crossorigin="anonymous"></script>
<script src="<?php echo base_url();?>jsPDF/dist/jspdf.debug.js"></script>
<script src="<?php echo base_url();?>jsPDF/html2canvas.js"></script>

<style>
    #toPDF{
        margin: auto;
        background-color: white;
    }

    #planning {
        margin: auto;
        font-size: 24px;
    }
    table {
        empty-cells: hide;
    }
    table td {
        border:2px solid gray;
        text-align: center;
    }
    .prof1 {
        background-color: lightgreen;
        float: left;
        width: 50%;
    }
    .prof2 {
        background-color: lightblue;
        float: right;
        width: 50%;
    }
    .info_soutenance{
        border:3px solid black;
        height:60px;
    }
    #salle_td {
    }
    .salle {
        padding-top: 15px;
        padding-bottom: 15px;
        height:30px;
        border: solid 3px black;
    }


    #prof td {
        border: none;
    }
    #prof {
        margin: auto;
        margin-top: 100px;
    }

</style>
<body>
<div id="toPDF">

    <h1 style="text-align: center;padding-top: 100px;">PLANNING SOUTENANCES</h1>

    <table id="planning">
        <thead>
            <tr>
                <td></td>
                <td></td>
                <?php foreach($date as $day){
                    setlocale (LC_TIME, 'fr_FR.utf8','fra');
                    echo "<td>".strftime("%A %d/%m",strtotime($day))."</td>";
                }?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($horaire as $hor){ ?>
                <tr>
                    <td><?php echo $hor; ?></td>
                    <td id="salle_td">
                        <?php foreach($salle_horaire[$hor] as $salle){
                            echo "<div class='salle'>".$salle."</div>";
                        } ?>
                    </td>
                    <?php foreach ($date as $day){
                        echo "<td>";
                       foreach($data as $soutenance){
                           if ($soutenance->date == $day && $soutenance->horaire == $hor){
                               echo "<div class='info_soutenance'><div><div class='prof1'>".$soutenance->prof1."</div>
                               <div class='prof2'>".$soutenance->prof2."</div></div>
                               <div>".$soutenance->id_etudiant."</div></div>";
                           }
                       }
                        echo "</td>";
                    }?>
                </tr>
             <?php } ?>
        </tbody>
    </table>



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
var pdf = new jsPDF('p', 'pt', 'letter');
pdf.addHTML($('#toPDF')[0], function () {
    pdf.save('Planning.pdf');
    window.location.href = "<?php echo base_url() ?>index.php/C_admin";
});
</script>


</body>

