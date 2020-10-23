<?php $render('header', ['loggedUser'=>$loggedUser]); ?>
<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'search']);?>
        <section class="feed">

            <div class="row">
                <div class="column pr-5" style="width: 800px;">

                <h1>Você psquisou por: <?=$searchTerm;?></h1>
                <div class="full-friend-list">

               <?php foreach($users as $user): ?>
                    <div class="friend-icon">
                        <a href="<?=$base;?>/perfil/<?=$user->id;?>">
                            <div class="friend-icon-avatar">
                                <img src="<?=$base;?>/media/avatars/<?=$user->avatar;?>" />
                            </div>
                            <div class="friend-icon-name">
                                <?=$user->name;?>
                            </div>
                        </a>
                    </div>
                <?php endforeach;?>

                    
                
                </div>
                <div class="column side pl-5">
                    <?=$render('right-side');?>
                </div>
                
            </div>

        

                                    
        </div>

        </section>
</section>
<?=$render('footer');?>