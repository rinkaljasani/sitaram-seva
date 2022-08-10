<?php
use Illuminate\Support\Facades\Auth;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Dashboard ---------------------------------------------------------------------------------------------------------------------------------------------------
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
	$breadcrumbs->push('Dashboard', route(Auth::getDefaultDriver() . '.dashboard.index'));
});



	// Quick Links
	Breadcrumbs::register('quick_link', function ($breadcrumbs) {
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push(__('Mange Quick Link'), route('admin.quickLink'));
	});
	// Profile
	Breadcrumbs::register('my_profile', function ($breadcrumbs) {
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push(__('Manage Account'), route('admin.profile-view'));
	});


// Users -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('users_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
	    $breadcrumbs->push('Users', route(Auth::getDefaultDriver().'.users.index'));
	});

	Breadcrumbs::register('users_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('users_list');
	    $breadcrumbs->push('Add New User', route(Auth::getDefaultDriver().'.users.create'));
	});

	Breadcrumbs::register('users_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('users_list');
	    $breadcrumbs->push('Edit User', route(Auth::getDefaultDriver().'.users.edit', $id));
	});

	Breadcrumbs::register('users_show', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('users_list');
	    $breadcrumbs->push('View User', route(Auth::getDefaultDriver().'.users.show', $id));
	});

	// Role Management -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('roles_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
	    $breadcrumbs->push('Roles', route(Auth::getDefaultDriver().'.roles.index'));
	});
	Breadcrumbs::register('roles_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('roles_list');
	    $breadcrumbs->push('Add New Role', route(Auth::getDefaultDriver().'.roles.create'));
	});
	Breadcrumbs::register('roles_update', function ($breadcrumbs, $id)
	{
		$breadcrumbs->parent('roles_list');
		$breadcrumbs->push(__('Edit Role'), route('admin.roles.edit', $id));
	});

	// countries -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('countries_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
	    $breadcrumbs->push('Countries', route(Auth::getDefaultDriver().'.countries.index'));
	});
	Breadcrumbs::register('countries_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('countries_list');
	    $breadcrumbs->push('Add New Country', route(Auth::getDefaultDriver().'.countries.create'));
	});

	Breadcrumbs::register('countries_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('countries_list');
	    $breadcrumbs->push('Edit Country', route(Auth::getDefaultDriver().'.countries.edit', $id));
	});

	// states -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('states_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push('states', route(Auth::getDefaultDriver().'.states.index'));
	});
	Breadcrumbs::register('states_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('states_list');
		$breadcrumbs->push('Add New State', route(Auth::getDefaultDriver().'.states.create'));
	});

	Breadcrumbs::register('states_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('states_list');
		$breadcrumbs->push('Edit State', route(Auth::getDefaultDriver().'.states.edit', $id));
	});

	Breadcrumbs::register('states_show', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('states_list');
	    $breadcrumbs->push('View State', route(Auth::getDefaultDriver().'.states.show', $id));
	});

	// cities list -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('cities_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push('Cities', route(Auth::getDefaultDriver().'.cities.index'));
	});
	Breadcrumbs::register('cities_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('cities_list');
		$breadcrumbs->push('Add New Cities', route(Auth::getDefaultDriver().'.cities.create'));
	});

	Breadcrumbs::register('cities_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('cities_list');
		$breadcrumbs->push('Edit Cities', route(Auth::getDefaultDriver().'.cities.edit', $id));
	});

	Breadcrumbs::register('cities_show', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('cities_list');
	    $breadcrumbs->push('View Cities', route(Auth::getDefaultDriver().'.cities.show', $id));
	});

	// addresses list -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('addresses_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push('addresses', route(Auth::getDefaultDriver().'.addresses.index'));
	});
	Breadcrumbs::register('addresses_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('addresses_list');
		$breadcrumbs->push('Add New Address', route(Auth::getDefaultDriver().'.addresses.create'));
	});

	Breadcrumbs::register('addresses_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('addresses_list');
		$breadcrumbs->push('Edit Address', route(Auth::getDefaultDriver().'.addresses.edit', $id));
	});

	Breadcrumbs::register('addresses_show', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('addresses_list');
	    $breadcrumbs->push('View Address', route(Auth::getDefaultDriver().'.addresses.show', $id));
	});
	
	// categoies list -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('categoies_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push('categoies', route(Auth::getDefaultDriver().'.categoies.index'));
	});
	Breadcrumbs::register('categoies_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('categoies_list');
		$breadcrumbs->push('Add New Category', route(Auth::getDefaultDriver().'.categoies.create'));
	});

	Breadcrumbs::register('categoies_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('categoies_list');
		$breadcrumbs->push('Edit Category', route(Auth::getDefaultDriver().'.categoies.edit', $id));
	});

	Breadcrumbs::register('categoies_show', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('categoies_list');
	    $breadcrumbs->push('View Category', route(Auth::getDefaultDriver().'.categoies.show', $id));
	});
	


	// events list -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('events_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push('events', route(Auth::getDefaultDriver().'.events.index'));
	});
	Breadcrumbs::register('events_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('events_list');
		$breadcrumbs->push('Add New Events', route(Auth::getDefaultDriver().'.events.create'));
	});

	Breadcrumbs::register('events_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('events_list');
		$breadcrumbs->push('Edit Events', route(Auth::getDefaultDriver().'.events.edit', $id));
	});

	Breadcrumbs::register('events_show', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('events_list');
	    $breadcrumbs->push('View Events', route(Auth::getDefaultDriver().'.events.show', $id));
	});
	

	// events list -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('donation_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push('Donation', route(Auth::getDefaultDriver().'.donations.index'));
	});
	Breadcrumbs::register('donation_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('donation_list');
		$breadcrumbs->push('Add New Donation', route(Auth::getDefaultDriver().'.donations.create'));
	});

	Breadcrumbs::register('donation_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('donation_list');
		$breadcrumbs->push('Edit Donation', route(Auth::getDefaultDriver().'.donations.edit', $id));
	});

	Breadcrumbs::register('donation_show', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('donation_list');
	    $breadcrumbs->push('View Donation', route(Auth::getDefaultDriver().'.donations.show', $id));
	});


	// volunteer list -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('volunteers_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push('Team', route(Auth::getDefaultDriver().'.volunteers.index'));
	});
	Breadcrumbs::register('volunteers_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('volunteers_list');
		$breadcrumbs->push('Add New Team member', route(Auth::getDefaultDriver().'.volunteers.create'));
	});

	Breadcrumbs::register('volunteers_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('volunteers_list');
		$breadcrumbs->push('Edit Team member', route(Auth::getDefaultDriver().'.volunteers.edit', $id));
	});

	Breadcrumbs::register('volunteers_show', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('volunteers_list');
	    $breadcrumbs->push('View Team member', route(Auth::getDefaultDriver().'.volunteers.show', $id));
	});
	

	// Faqs -------------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('faqs_list', function($breadcrumbs)
	{
		$breadcrumbs->parent('dashboard');
	    $breadcrumbs->push('Faqs', route(Auth::getDefaultDriver().'.faqs.index'));
	});
	Breadcrumbs::register('faqs_create', function($breadcrumbs)
	{
		$breadcrumbs->parent('faqs_list');
	    $breadcrumbs->push('Add New Faq', route(Auth::getDefaultDriver().'.faqs.create'));
	});

	Breadcrumbs::register('faqs_update', function($breadcrumbs, $id)
	{
		$breadcrumbs->parent('faqs_list');
	    $breadcrumbs->push('Edit Faq', route(Auth::getDefaultDriver().'.faqs.edit', $id));
	});


	// CMS Pages ---------------------------------------------------------------------------------------------------------------------------------------------------
	Breadcrumbs::register('cms_list', function ($breadcrumbs) {
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push(__('CMS Pages'), route('admin.pages.index'));
	});
	Breadcrumbs::register('cms_update', function ($breadcrumbs, $id) {
		$breadcrumbs->parent('cms_list');
		$breadcrumbs->push(__('Edit CMS Page'), route('admin.pages.edit', $id));
	});
//site configuartion
	Breadcrumbs::register('site_setting', function ($breadcrumbs) {
		$breadcrumbs->parent('dashboard');
		$breadcrumbs->push(__('Site Configuration'), route('admin.settings.index'));
	});
