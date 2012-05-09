<?php
$pageTitle = __('Advanced Search');
if (!$isPartial):
    head(array('title' => $pageTitle,
               'bodyclass' => 'advanced-search',
               'bodyid' => 'advanced-search-page'));
?>
<?php if(!is_admin_theme()): ?>
<div id="primary">
<?php endif; ?>

<h1><?php echo $pageTitle; ?></h1>

<?php if(is_admin_theme()): ?>
<div id="primary">
<?php endif; ?>

<?php endif; ?>

<?php
if ($formActionUri):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = uri(array('controller'=>'items',
                                          'action'=>'browse'));
endif;
$formAttributes['method'] = 'GET';
?>

    <form <?php echo _tag_attributes($formAttributes); ?>>
        <div id="search-keywords" class="field">
            <?php echo label('keyword-search', __('Search for Keywords')); ?>
            <div class="inputs">
            <?php echo text(array(
                    'name' => 'search',
                    'size' => '40',
                    'id' => 'keyword-search',
                    'class' => 'textinput'), @$_REQUEST['search']); ?>
            </div>
        </div>
        <div id="search-narrow-by-fields" class="field">
            <div class="label"><?php echo __('Narrow by Specific Fields'); ?></div>
            <div class="inputs">
            <?php
            // If the form has been submitted, retain the number of search
            // fields used and rebuild the form
            if (!empty($_GET['advanced'])) {
                $search = $_GET['advanced'];
            } else {
                $search = array(array('field'=>'','type'=>'','value'=>''));
            }

            //Here is where we actually build the search form
            foreach ($search as $i => $rows): ?>
                <div class="search-entry">
                    <?php
                    //The POST looks like =>
                    // advanced[0] =>
                    //[field] = 'description'
                    //[type] = 'contains'
                    //[terms] = 'foobar'
                    //etc
                    echo select_element(
                        array('name' => "advanced[$i][element_id]"),
                        @$rows['element_id'],
                        null,
                        array('record_types' => array('Item', 'All'),
                              'sort' => 'alphaBySet'));
                    echo select(
                        array('name' => "advanced[$i][type]"),
                        array('contains' => __('contains'),
                              'does not contain' => __('does not contain'),
                              'is exactly' => __('is exactly'),
                              'is empty' => __('is empty'),
                              'is not empty' => __('is not empty')),
                        @$rows['type']
                    );
                    echo text(
                        array('name' => "advanced[$i][terms]",
                              'size' => 20),
                        @$rows['terms']); ?>
                    <button type="button" class="remove_search" disabled="disabled" style="display: none;">-</button>
                </div>
            <?php endforeach; ?>
            </div>
            <button type="button" class="add_search"><?php echo __('Add a Field'); ?></button>
        </div>


        <div id="search-selects">
            <div class="field">
                <?php echo label('collection-search', __('Search By Collection')); ?>
                <div class="inputs"><?php
                    echo select_collection(array(
                        'name' => 'collection',
                        'id' => 'collection-search'
                    ), @$_REQUEST['collection']); ?>
                </div>
            </div>

        </div>

        <?php //is_admin_theme() ? fire_plugin_hook('admin_append_to_advanced_search') : fire_plugin_hook('public_append_to_advanced_search'); ?>
        <div>
            <input type="submit" class="submit" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
        </div>
    </form>

<?php echo js('search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
    });
</script>

<?php if (!$isPartial): ?>
</div> <!-- Close 'primary' div. -->
<?php foot(); ?>
<?php endif; ?>
