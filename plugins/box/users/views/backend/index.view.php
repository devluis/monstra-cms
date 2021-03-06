<h2><?php echo __('Users', 'users'); ?></h2>
<br />

<?php if (Notification::get('success')) Alert::success(Notification::get('success')); ?>

<?php echo Html::anchor(__('Register New User', 'users'), 'index.php?id=users&action=add', array('title' => __('Register New User', 'users'), 'class' => 'btn default btn-small')); ?>

<div class="pull-right">
<?php echo Form::open(null, array('name' => 'users_frontend')); ?>
<?php echo Form::hidden('csrf', Security::token()); ?>
<?php echo Form::checkbox('users_frontend_registration', null, $users_frontend_registration); ?> <?php echo __('Allow user registration', 'users') ?>
<?php echo Form::input('users_frontend_submit', 'users_frontend_submit', array('style' => 'display:none;')); ?>
<?php echo Form::close();?>
</div>

<br /><br />

<!-- Users_list -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th><?php echo __('Username', 'users'); ?></th>
            <th class="hidden-phone"><?php echo __('Email', 'users'); ?></th>
            <th class="hidden-phone"><?php echo __('Registered', 'users'); ?></th>
            <th class="hidden-phone"><?php echo __('Role', 'users'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users_list as $user) { ?>
    <tr>
        <td>
            <?php echo Html::toText($user['login']); ?>
        </td>
        <td class="hidden-phone">
            <?php echo Html::toText($user['email']); ?>
        </td>
        <td class="hidden-phone">
            <?php echo Date::format($user['date_registered']); ?>
        </td>
        <td class="hidden-phone">
            <?php echo $roles["{$user['role']}"]; ?>
        </td>
        <td>
            <div class="pull-right">
            <?php echo Html::anchor(__('Edit', 'users'), 'index.php?id=users&action=edit&user_id='.$user['id'], array('class' => 'btn btn-small')); ?>
            <?php
                if ((int)$user['id'] != (int)$_SESSION['user_id']) {
                    echo Html::anchor(__('Delete', 'users'),
                       'index.php?id=users&action=delete&user_id='.$user['id'].'&token='.Security::token(),
                       array('class' => 'btn btn-small', 'onclick' => "return confirmDelete('".__('Delete user: :user', 'users', array(':user' => Html::toText($user['login'])))."')"));
                }
             ?>
             </div>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<!-- /Users_list -->
