<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//array_shift($students);
?>

<link href="<?php echo base_url();?>assets/css/update_promo.css" rel="stylesheet">
<link href="x²" rel="stylesheet">
<script src="<?=base_url();?>assets/js/update_promo.js"></script>

<link href="<?php echo base_url();?>assets/css/gestion_notation.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/gsdk.css" rel="stylesheet">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-lg-10 col-md-10 text-center" id="container_admin">
    <section>
        <h2>Gestion des promotions</h2>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Initialisation">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Connexion LDAP">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">

                        <!--                    STEP 3-->
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Resultats">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Enregistrement">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-ok"></i>
                                </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form role="form">
                <div class="tab-content">

                    <!--                    STEP 1-->
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <div class="form-wrap ">
                            <form id="formNewPromo" method="post" action="">
                                <div class="step1">

                                    <div class="form-group">
                                        <label for="year">Promotion</label>
                                        <select id="year"class="form-control">
                                            <?php
                                            foreach($promos as $promo){
                                                $nom = $promo["nom"];
                                                $name_ldap = $promo["name_ldap"];
                                                $id = $promo["id"];
                                                //Affichage des info utilisateur pour les tests uniquement
                                                echo "<option id='".$id."' value='".$name_ldap."'>".$nom. '</option><br />';
                                                //Nom promo: text entre balises
                                                //id promo = id du option
                                                //name ldap = value du option
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <ul class="list-inline ">
                                    <li><button type="button" id="goStep2" class="btn btn-primary next-step">Continuer
                                            <i class="glyphicon glyphicon-menu-right"></i>
                                        </button></li>
                                </ul>
                            </form>
                        </div>
                    </div>

                    <!--                    STEP 2 LDAP CONNECT-->
                    <div class="tab-pane" role="tabpanel" id="step2">

                        <div class="step2">
                            <div class="form-group">                                        <label for="login">Compte ldap UBFC</label>
                                <input type="text" class="form-control" id="login" placeholder="Identifiant" value="ihajali">
                            </div>
                            <br>
                            <div class="form-group">                                        <label for="password">Mot de passe</label>
                                <input type="password" class="form-control" id="password" placeholder="Mot de passe" value="yesadolyon00769*">
                            </div>

                        </div>
                        <ul class="list-inline">
                            <li><button type="button" class="btn btn-default prev-step">Retour</button></li>
                            <li><button type="button" id="goStep3" class="btn btn-primary next-step">Continuer</button></li>
                        </ul>
                    </div>

                    <!--                    STEP 3 SHOW RESULTS-->
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <div class="step33">

                            <div class="container">
                                <div class="col-md-10 col-md-offset-1">

                                    <div class="panel panel-default panel-table">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col col-xs-6">
                                                    <h3 class="panel-title"><strong><span id="nbResults"></span> résultats trouvé(s).</strong></h3>
                                                </div>
                                                <div class="col col-xs-6 text-right">
                                                    <button type="button" class="btn btn-default prev-step">Retour</button>
                                                    <button type="button" id="goStep4"class="btn btn-primary btn-info-full next-step">Créer la promotion</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered table-list">
                                                <thead>
                                                <tr>
                                                    <th class="hidden-sm">UID</th>
                                                    <th>Nom prénom</th>
                                                </tr>
                                                </thead>
                                                <tbody id="results">
                                                <!--                                                    Resltats ici-->
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col col-xs-8">
                                                    <ul class="pagination visible-xs pull-right">
                                                        creat</ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="container">
                                <table>
                                    <thead>
                                    <th style="width:40%">Nom prénom</th>
                                    <th style="width:20%">uid</th>
                                    <th style="width:20%">mail</th>
                                    </thead>
                                    <tbody id="results">
                                    <!--                                    <tr>-->
                                    <!--                                        <td>Jean Didier</td>-->
                                    <!--                                        <td>jdidier</td>-->
                                    <!--                                        <th>jean.didier@univ-fcomte.fr</th>-->
                                    <!--                                    </tr>-->
                                    </tbody>
                                </table>
                            </div>


                            <!--                            bouton de la NAVIGATION-->
                            <ul class="list-inline">
                                <li><button type="button" class="btn btn-default prev-step">Retour</button></li>
                                <li><button type="button" id="goStep4"class="btn btn-primary btn-info-full next-step">Créer la promotion</button></li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-pane" role="tabpanel" id="complete">

                        <!--                    STEP 4-->
                        <div class="step44">
                            <h5>Completed</h5>


                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
</div>