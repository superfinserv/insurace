<div class="row">
    <div class="col-md-12">
        @isset($temp)
         <?php $html = html_entity_decode($temp->body);
         echo $html;?>
        @endisset
    </div>
</div>