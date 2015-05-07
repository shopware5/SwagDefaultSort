{* Sorting filter which will be included in the "listing/listing_actions.tpl" *}
{namespace name="frontend/swagdefaultsort/main"}

{extends file="parent:frontend/listing/actions/action-sorting.tpl"}

{block name="frontend_listing_actions_sort_field_release" prepend}
    <option value="swag_default_sort"{if $sSort eq 'swag_default_sort'} selected="selected"{/if}>{s name='ListingSortDefault'}{/s}</option>
{/block}