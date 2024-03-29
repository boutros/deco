<?php
/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Center for History and New Media, 2010
 * @package Contribution
 */

$head = array('title' => 'Bidra med et bilde til basen',
              'bodyclass' => 'contribution');
head($head); ?>
<?php echo js('contribution-public-form'); ?>
<script type="text/javascript">
// <![CDATA[
enableContributionAjaxForm(<?php echo js_escape(uri('contribution/type-form')); ?>);
// ]]>
</script>

<div id="primary">
<?php echo flash(); ?>
    
    <h1><?php echo $head['title']; ?></h1>
    <p>Mange av feltene er knyttet til et autoritetsregister. Er det noen valg som mangler i nedtrekkslistene,<br>
        så skriv det i feltet 'andre kommentarer' nederst på siden. F.eks slik: "Person: Halvorsen, Knut."</p>
    <form method="post" action="" enctype="multipart/form-data">
        <fieldset id="contribution-item-metadata">
            <div class="inputs" style="display:none">
                  <label for="contribution-type">Type bidrag:</label>
                <?php echo contribution_select_type(array( 'name' => 'contribution_type', 'id' => 'contribution-type'), $_POST['contribution_type']); ?>
                <input type="submit" name="submit-type" id="submit-type" value="Select" />
            </div>
            <div id="contribution-type-form" style="margin-bottom:10px">
            <?php if (isset($typeForm)): echo $typeForm; endif; ?>
            </div>
        </fieldset>
        <fieldset id="contribution-contributor-metadata" <?php if (!isset($typeForm)) { echo 'style="display: none;"'; }?>>
            <legend>Informasjon om deg</legend>
            <div class="field">
                <label for="contributor-name">Navn</label>
                <div class="inputs">
                    <div class="input">
                        <?php echo $this->formText('contributor-name', $_POST['contributor-name'], array('class' => 'textinput')); ?>
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="contributor-email">E-postadresse</label>
                <div class="inputs">
                    <div class="input">
                        <?php echo $this->formText('contributor-email', $_POST['contributor-email'], array('class' => 'textinput')); ?>
                    </div>
                </div>
            </div>
        <?php
        foreach (contribution_get_contributor_fields() as $field) {
            echo $field;
        }
        ?>
        </fieldset>
        <fieldset id="contribution-confirm-submit" <?php if (!isset($typeForm)) { echo 'style="display: none;"'; }?>>
            <div id="captcha" class="inputs"><?php echo $captchaScript; ?></div>
            <div class="inputs">
                <?php echo $this->formCheckbox('contribution-public', $_POST['contribution-public'], null, array('1', '0')); ?>
                <?php echo $this->formLabel('contribution-public', 'Offentliggjør bildet på internet.'); ?>
            </div>
            <p>For å bidra med et bilde må du lese og godta <a href="<?php echo uri('contribution/terms') ?>" target="_blank">våre vilkår.</a></p>
            <div class="inputs">
                <?php echo $this->formCheckbox('terms-agree', $_POST['terms-agree'], null, array('1', '0')); ?>
                <?php echo $this->formLabel('terms-agree', 'Jeg godtar vilkårene for å bidra.'); ?>
            </div>
            <?php echo $this->formSubmit('form-submit', 'Send inn bidrag', array('class' => 'submitinput')); ?>
        </fieldset>
    </form>
</div>
<?php foot();
