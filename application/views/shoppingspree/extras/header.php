<?php
    if(current_url() === base_url().'cart')
    {
        $link = base_url();
        $value = "Catalog";
    }
    else if(current_url() === base_url())
    {
        $link = base_url().'cart';
        $value = "Cart (3)";
    }
?>
<header><!--
---><h1>My Store</h1><!--
---><a href="<?= $link ?>"><?= $value ?></a><!--
---></header><!-- -->