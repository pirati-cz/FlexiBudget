<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FlexiBudget\ui;

/**
 * Description of FlxBeeAddrSelector
 *
 * @author vitex
 */
class FlxBeeAddrSelector
{
    public function finalize()
    {
        
    }
}
?>

<div class = "input-group">
    <div class = "input-group-addon"><i class = "fa fa-list-alt fa-fw "></i></div>

    <div id = "s2id_flexibee-inp-firma" class = "select2-container flexibee-flexbox flexibee-focus flexibee-inp"><a href
                                                                                                                    = "javascript:void(0)" class = "select2-choice select2-default" tabindex = "-1"> <span id
                                                                                               = "select2-chosen-1" class = "select2-chosen">Firma</span><abbr class = "select2-search-choice-close"></abbr> <span class
                                                                                               = "select2-arrow" role = "presentation"><b role = "presentation"></b></span></a><label for
                                                                                               = "s2id_autogen1" class = "select2-offscreen">Firma:</label><input id = "s2id_autogen1" aria-labelledby
                                                                           = "select2-chosen-1" class = "select2-focusser select2-offscreen" aria-haspopup = "true" role
                                                                           = "button" type = "text"><div class = "select2-drop select2-display-none select2-with-searchbox"> <div class
                                                                                                               = "select2-search"> <label for = "s2id_autogen1_search" class = "select2-offscreen">Firma:</label> <input placeholder
                                                                                                                      = "" id = "s2id_autogen1_search" aria-owns = "select2-results-1" autocomplete = "off" autocorrect
                                                                                                                      = "off" autocapitalize = "off" spellcheck = "false" class = "select2-input" role
                                                                                                                      = "combobox" aria-expanded = "true" aria-autocomplete = "list" type = "text"> </div> <ul id
                                                                                                     = "select2-results-1" class = "select2-results" role = "listbox"> </ul></div></div><input title
                                                                                              = "Firma:" tabindex = "-1" name = "firma" data-placeholder = "Firma" id = "flexibee-inp-firma" class
                                                                                              = "flexibee-flexbox flexibee-focus  flexibee-inp  select2-offscreen" type = "text">
</div>
<script type = "text/javascript">
    $(function () {
        initFlexBox('firma', 'Firma', 'https://localhost:5434/c/ceska_piratska_strana/adresar.json?mode=suggest', '', '', ' form-control');
    });
</script>

<script>
    $(document).ready(function () {

</script>
