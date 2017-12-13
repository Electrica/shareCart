<table class="table">
    <thead>
    <tr>
        <td>Ссылка</td>
        <td>Корзина</td>
        <td>Действия</td>
    </tr>
    </thead>
    <tbody>
    {foreach $carts as $cart}

    <tr>
        <td>{$cart.link}</td>
        <td>
            {foreach $cart.carts as $c}
                {foreach $c as $v}
                <a href="{$v.id|url}">{$v.id|resource:'pagetitle'}</a><br>
                {/foreach}
            {/foreach}
        </td>
        <td>
            <a href="#" data-id-sharecart="{$cart.carts.id}" id="delete-sharecart">Удалить</a>
            
        </td>
    </tr>

    {/foreach}
    </tbody>
</table>