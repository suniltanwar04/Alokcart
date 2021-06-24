<?php
// Route::get('attribute/{attribute}/entities', 'AttributeController@entities')->name('attribute.entities');
// Route::delete('attribute/{attribute}/trash', 'AttributeController@trash')->name('attribute.trash');
// Route::get('attribute/{attribute}/restore', 'AttributeController@restore')->name('attribute.restore');
// Route::post('attribute/massTrash', 'AttributeController@massTrash')->name('attribute.massTrash')->middleware('demoCheck');
// Route::post('attribute/massDestroy', 'AttributeController@massDestroy')->name('attribute.massDestroy')->middleware('demoCheck');
// Route::delete('attribute/emptyTrash', 'AttributeController@emptyTrash')->name('attribute.emptyTrash');
// Route::post('attribute/reorder', 'AttributeController@reorder')->name('attribute.reorder');
Route::get('/','LeadGenerationController@index')->name('Lead_Generation');
Route::get('/webLeads','LeadGenerationController@web_leads')->name('Lead_Generation');
Route::get('/reportedLeads','LeadGenerationController@reported_leads')->name('Lead_Generation');
Route::get('/buyLeads','LeadGenerationController@buy_leads')->name('Lead_Generation');
Route::get('/open','LeadGenerationController@open')->name('Lead_Generation');
Route::get('/active','LeadGenerationController@active')->name('Lead_Generation');
Route::get('/closed','LeadGenerationController@closed')->name('Lead_Generation');




Route::post('/updateLead/','LeadGenerationController@updateSeller')->name('Update_Lead');
Route::post('/updateLeadStatus/','LeadGenerationController@updateLeadStatus')->name('Update_Lead');
Route::post('/updateSellerLead/','LeadGenerationController@updateSellerLead')->name('Update_Lead');
Route::get('/details','LeadGenerationController@leadDetails')->name('Lead_Details');

Route::delete('/lead/{id}/trash', 'LeadGenerationController@trash')->name('lead.trash');

Route::post('/lead/{id}/unreport', 'LeadGenerationController@unreport')->name('lead.unreport');

Route::get('/lead/{id}/report', 'LeadGenerationController@report')->name('lead.report');
Route::get('/lead/{id}/internal', 'LeadGenerationController@internal')->name('lead.internal');

Route::post('/bulkuploadleads/','LeadGenerationController@bulkImport')->name('Bulk_Import');
Route::get('lead/{leadId}/restore', 'LeadGenerationController@restore')->name('lead.restore');
Route::resource('lead', 'LeadGenerationController');
Route::delete('lead/emptyTrash', 'LeadGenerationController@emptyTrash')->name('lead.emptyTrash');
// echo "all files";