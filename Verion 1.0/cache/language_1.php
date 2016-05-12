<?php
if(!isset($GLOBALS['all_words'])){
	$GLOBALS['all_words'] = array (
  '[[.PostItems_by_email.]]' => 'PostItems by email',
  '[[.submit_form.]]' => 'Submit form',
  '[[.hide_countries.]]' => 'Hide countries',
  '[[.other_countries.]]' => 'Other countries',
  '[[.Term_and_condition.]]' => 'Term and condition',
  '[[.Privacy_statement.]]' => 'Privacy statement',
  '[[.Contact_us.]]' => 'Contact us',
  '[[.FAQ.]]' => 'FAQ',
  '[[.Afrikaans.]]' => 'Afrikaans',
  '[[.Albanian.]]' => 'Albanian',
  '[[.Arabic.]]' => 'Arabic',
  '[[.Belarusian.]]' => 'Belarusian',
  '[[.Bulgarian.]]' => 'Bulgarian',
  '[[.Catalan.]]' => 'Catalan',
  '[[.Croatian.]]' => 'Croatian',
  '[[.Czech.]]' => 'Czech',
  '[[.Danish.]]' => 'Danish',
  '[[.Estonian.]]' => 'Estonian',
  '[[.Filipino.]]' => 'Filipino',
  '[[.Finnish.]]' => 'Finnish',
  '[[.Galician.]]' => 'Galician',
  '[[.Greek.]]' => 'Greek',
  '[[.Hebrew.]]' => 'Hebrew',
  '[[.Hindi.]]' => 'Hindi',
  '[[.Hungarian.]]' => 'Hungarian',
  '[[.Icelandic.]]' => 'Icelandic',
  '[[.Indonesian.]]' => 'Indonesian',
  '[[.Irish.]]' => 'Irish',
  '[[.Italian.]]' => 'Italian',
  '[[.Latvian.]]' => 'Latvian',
  '[[.Lithuanian.]]' => 'Lithuanian',
  '[[.Macedonian.]]' => 'Macedonian',
  '[[.Malay.]]' => 'Malay',
  '[[.Maltese.]]' => 'Maltese',
  '[[.Norwegian.]]' => 'Norwegian',
  '[[.Persian.]]' => 'Persian',
  '[[.Polish.]]' => 'Polish',
  '[[.Portuguese.]]' => 'Portuguese',
  '[[.Romanian.]]' => 'Romanian',
  '[[.Russian.]]' => 'Russian',
  '[[.Serbian.]]' => 'Serbian',
  '[[.Slovenian.]]' => 'Slovenian',
  '[[.Spanish.]]' => 'Spanish',
  '[[.Swedish.]]' => 'Swedish',
  '[[.Thai.]]' => 'Thai',
  '[[.Turkish.]]' => 'Turkish',
  '[[.Ukrainian.]]' => 'Ukrainian',
  '[[.Welsh.]]' => 'Welsh',
  '[[.first_name_is_required.]]' => 'First name is required',
  '[[.last_name_is_required.]]' => 'Last name is required',
  '[[.email_is_required.]]' => 'Email is required',
  '[[.incorrect_email_format.]]' => 'Incorrect email format',
  '[[.content_is_required.]]' => 'Yêu cầu phải nhập nội dung sốc',
  '[[.please_enter_at_smaller_or_with_1000_characters.]]' => 'Bạn nhập nhỏ hơn 1000 ký tự',
  '[[.verity_confirm_code_is_required.]]' => 'Mã bảo vệ yêu cầu phải nhập',
  '[[.verity_confirm_code_is_smaller_4.]]' => 'Mã bảo vệ phải nhập 4 ký tự',
  '[[.verify_confirm_code_is_invalid.]]' => 'Nhập sai mã bảo vệ',
  '[[.customer_service.]]' => 'Customer service',
  '[[.customer_service_by_phone.]]' => 'Customer service by phone',
  '[[.next_page.]]' => 'Next page',
  '[[.list_title.]]' => 'List title',
  '[[.delete_cache.]]' => 'Delete cache',
  '[[.Add.]]' => 'Add',
  '[[.Add_block.]]' => 'Add block',
  '[[.Delete.]]' => 'Delete',
  '[[.packages/admin.]]' => 'Packages/admin',
  '[[.name.]]' => 'Name',
  '[[.portal.]]' => 'Portal',
  '[[.search.]]' => 'Search',
  '[[.check_all.]]' => 'Check all',
  '[[.sort.]]' => 'Sort',
  '[[.title.]]' => 'Title',
  '[[.package_id.]]' => 'Package id',
  '[[.params.]]' => 'Params',
  '[[.Edit.]]' => 'Edit',
  '[[.duplicate.]]' => 'Duplicate',
  '[[.select.]]' => 'Select',
  '[[.select_all.]]' => 'Select all',
  '[[.select_none.]]' => 'Select none',
  '[[.select_invert.]]' => 'Select invert',
  '[[.top.]]' => 'Top',
  '[[.edit_layout.]]' => 'Edit layout',
  '[[.welcome.]]' => 'Welcome',
  '[[.sign_out.]]' => 'Sign out',
  '[[.home.]]' => 'Home',
  '[[.Home_page.]]' => 'Home page',
  '[[.Help.]]' => 'Help',
  '[[.Stop.]]' => 'Stop',
  '[[.Runing.]]' => 'Runing',
  '[[.config_manage.]]' => 'Config manage',
  '[[.Account_setting.]]' => 'Account setting',
  '[[.Save.]]' => 'Ghi lại',
  '[[.Front_back_config.]]' => 'Front back config',
  '[[.System_config.]]' => 'System config',
  '[[.Setting_name.]]' => 'Setting name',
  '[[.Value.]]' => 'Value',
  '[[.top_hotel.]]' => 'Top hotel',
  '[[.templates.]]' => 'Templates',
  '[[.size_upload.]]' => 'Size upload',
  '[[.times.]]' => 'Times',
  '[[.upload.]]' => 'Upload',
  '[[.type_image_upload.]]' => 'Type image upload',
  '[[.type_file_upload.]]' => 'Type file upload',
  '[[.Use_cache.]]' => 'Use cache',
  '[[.rewrite_url.]]' => 'Rewrite url',
  '[[.use_double_click.]]' => 'Use double click',
  '[[.use_log.]]' => 'Use log',
  '[[.use_recycle_bin.]]' => 'Use recycle bin',
  '[[.language_default.]]' => 'Language default',
  '[[.site_title.]]' => 'Site title',
  '[[.site_name.]]' => 'Site name',
  '[[.icon_on_address.]]' => 'Icon on address',
  '[[.total_hotels.]]' => 'Total hotels',
  '[[.hotel_commission.]]' => 'Hotel commission',
  '[[.max_hotel_images.]]' => 'Max hotel images',
  '[[.tour_commission.]]' => 'Tour commission',
  '[[.ticket_commission.]]' => 'Ticket commission',
  '[[.email_support_online.]]' => 'Email support online',
  '[[.email_webmaster.]]' => 'Email webmaster',
  '[[.weblink.]]' => 'Weblink',
  '[[.path_link.]]' => 'Path link',
  '[[.support_online.]]' => 'Support online',
  '[[.nick_name.]]' => 'Nick name',
  '[[.nick.]]' => 'Nick',
  '[[.support_skype.]]' => 'Support skype',
  '[[.skype_name.]]' => 'Skype name',
  '[[.skype.]]' => 'Skype',
  '[[.company_adress.]]' => 'Company adress',
  '[[.company_phone.]]' => 'Company phone',
  '[[.company_fax.]]' => 'Company fax',
  '[[.contact_information.]]' => 'Contact information',
  '[[.Term_conditions.]]' => 'Term conditions',
  '[[.received_notification_from_contact_by_email.]]' => 'Received notification from contact by email',
  '[[.site_status.]]' => 'Site status',
  '[[.notification_when_interrption.]]' => 'Notification when interrption',
  '[[.hotels_resorts_note_when_register.]]' => 'Hotels resorts note when register',
  '[[.tours_note_when_register.]]' => 'Tours note when register',
  '[[.member_note_when_register.]]' => 'Member note when register',
  '[[.ticket_note_when_register.]]' => 'Ticket note when register',
  '[[.front_end_config.]]' => 'Front end config',
  '[[.footer_infor.]]' => 'Footer infor',
  '[[.footer_content.]]' => 'Footer content',
  '[[.meta_content.]]' => 'Meta content',
  '[[.keyword_is_required.]]' => 'Từ khóa yêu cầu phải nhập',
  '[[.please_enter_at_smaller_or_with_2000_characters.]]' => 'Chỉ được nhập tối đa 2000 ký tự',
  '[[.please_enter_at_least_4_characters.]]' => 'Please enter at least 4 characters',
  '[[.please_enter_at_least_10_characters.]]' => 'Làm ơn nhập tối thiểu 10 ký tự',
  '[[.please_enter_at_least_3_characters.]]' => 'Làm ơn nhập tối thiểu 3 ký tự',
  '[[.poster_is_required.]]' => 'Người gửi yêu cầu phải nhập',
  '[[.please_enter_at_smaller_or_with_30_characters.]]' => 'Chỉ được nhập tối đa 30 ký tự',
  '[[.invalid_confirm_code.]]' => 'Nhâp sai mã bảo vệ',
  '[[.item_information.]]' => 'Thông tin',
  '[[.register_hotel.]]' => 'Register hotel',
  '[[.register_user.]]' => 'Register user',
  '[[.Sign_in.]]' => 'Sign in',
  '[[.update.]]' => 'Update',
  '[[.delete_module_cache.]]' => 'Delete module cache',
  '[[.total.]]' => 'Total',
  '[[.Setting.]]' => 'Setting',
  '[[.add_title.]]' => 'Add title',
  '[[.save.]]' => 'Save',
  '[[.back.]]' => 'Quay lại',
  '[[.description.]]' => 'Description',
  '[[.image_url.]]' => 'Image url',
  '[[.type.]]' => 'Type',
  '[[.action.]]' => 'Action',
  '[[.on.]]' => 'On',
  '[[.use_dblclick.]]' => 'Use dblclick',
  '[[.Update_setting_code.]]' => 'Update setting code',
  '[[.Create_block_code.]]' => 'Create block code',
  '[[.Destroy_block_code.]]' => 'Destroy block code',
  '[[.module_table.]]' => 'Module table',
  '[[.table.]]' => 'Table',
  '[[.page.]]' => 'Trang',
  '[[.data_is_updating.]]' => 'Dữ liệu đang cập nhật',
  '[[.dupplicated_content.]]' => 'Nội dung bị trùng lặp',
  '[[.previous_page.]]' => 'Previous page',
  '[[.booking_report.]]' => 'Booking report',
  '[[.manage_user.]]' => 'Manage user',
  '[[.config_your_site.]]' => 'Config your site',
  '[[.logout.]]' => 'Logout',
  '[[.adv_list.]]' => 'Adv list',
  '[[.add_adv.]]' => 'Add adv',
  '[[.component.]]' => 'Component',
  '[[.setting_for.]]' => 'Setting for',
  '[[.of.]]' => 'Of',
  '[[.module_setting.]]' => 'Module setting',
  '[[.data_is_updated.]]' => 'Data is updated',
  '[[.close.]]' => 'Đóng',
  '[[.copy_from.]]' => 'Copy from',
  '[[.copy.]]' => 'Copy',
  '[[.delete_title.]]' => 'Delete title',
  '[[.make_cache.]]' => 'Make cache',
  '[[.list_all_function_of_system.]]' => 'List all function of system',
  '[[.cache.]]' => 'Cache',
  '[[.status.]]' => 'Status',
  '[[.function_add.]]' => 'Function add',
  '[[.group_name.]]' => 'Group name',
  '[[.parent_name.]]' => 'Parent name',
  '[[.url.]]' => 'Url',
  '[[.icon_url.]]' => 'Icon url',
  '[[.layout.]]' => 'Layout',
  '[[.cachable.]]' => 'Cachable',
  '[[.is_use_sapi.]]' => 'Is use sapi',
  '[[.cache_param.]]' => 'Cache param',
  '[[.condition.]]' => 'Condition',
  '[[.select_status.]]' => 'Select status',
  '[[.show.]]' => 'Show',
  '[[.hide.]]' => 'Hide',
  '[[.all_star.]]' => 'All star',
  '[[.Register_by_all.]]' => 'Register by all',
  '[[.CIVN_Register.]]' => 'CIVN Register',
  '[[.hotel_register.]]' => 'Hotel register',
  '[[.Checked_or_not.]]' => 'Checked or not',
  '[[.checked.]]' => 'Đã kiểm tra',
  '[[.not_check_yet.]]' => 'Not check yet',
  '[[.Contract_or_not.]]' => 'Contract or not',
  '[[.has_contract.]]' => 'Has contract',
  '[[.no_contract.]]' => 'No contract',
  '[[.room_availability.]]' => 'Room availability',
  '[[.All.]]' => 'All',
  '[[.room_available.]]' => 'Room available',
  '[[.room_not_available.]]' => 'Room not available',
  '[[.all_type.]]' => 'All type',
  '[[.save_and_send_mail.]]' => 'Save and send mail',
  '[[.save_only.]]' => 'Save only',
  '[[.cancel.]]' => 'Cancel',
  '[[.content_manage_system.]]' => 'Content manage system',
  '[[.manage_hotels.]]' => 'Manage hotels',
  '[[.list.]]' => 'List',
  '[[.You_must_select_atleast_item.]]' => 'You must select atleast item',
  '[[.Trash.]]' => 'Trash',
  '[[.New.]]' => 'New',
  '[[.Cache.]]' => 'Cache',
  '[[.Filter.]]' => 'Filter',
  '[[.display.]]' => 'Display',
  '[[.record.]]' => 'Record',
  '[[.are_you_sure.]]' => 'Are you sure',
  '[[.checked_and_uncheck_item.]]' => 'Checked and uncheck item',
  '[[.checked_item.]]' => 'Checked item',
  '[[.uncheck_item.]]' => 'Uncheck item',
  '[[.hote_or_not_item.]]' => 'Hote or not item',
  '[[.hot_item.]]' => 'Hot item',
  '[[.nornam_item.]]' => 'Nornam item',
  '[[.manage_item.]]' => 'Manage item',
  '[[.update_content.]]' => 'Update content',
  '[[.edit_code_title.]]' => 'Edit code title',
  '[[.edit_title.]]' => 'Edit title',
  '[[.edit_code.]]' => 'Edit code',
  '[[.select_category.]]' => 'Select category',
  '[[.select_user.]]' => 'Select user',
  '[[.manage_news.]]' => 'Manage news',
  '[[.Move.]]' => 'Move',
  '[[.Copy.]]' => 'Copy',
  '[[.are_you_sure_delete.]]' => 'Are you sure delete',
  '[[.front_page.]]' => 'Front page',
  '[[.positon.]]' => 'Positon',
  '[[.category_name.]]' => 'Category name',
  '[[.user_id.]]' => 'User id',
  '[[.date.]]' => 'Date',
  '[[.hitcount.]]' => 'Hitcount',
  '[[.id.]]' => 'Id',
  '[[.edit.]]' => 'Edit',
  '[[.manage_comment.]]' => 'Manage comment',
  '[[.content.]]' => 'Nội dung',
  '[[.user_post.]]' => 'User post',
  '[[.item.]]' => 'Item',
  '[[.day_post.]]' => 'Day post',
  '[[.publish.]]' => 'Publish',
  '[[.delete.]]' => 'Xóa',
  '[[.fetch_template.]]' => 'Fetch template',
  '[[.template_list.]]' => 'Template list',
  '[[.fetch_dantri.]]' => 'Fetch dantri',
  '[[.fetch_vnexpress.]]' => 'Fetch vnexpress',
  '[[.fetch_tuoitre.]]' => 'Fetch tuoitre',
  '[[.fetch_vietnamnet.]]' => 'Fetch vietnamnet',
  '[[.survey_admin.]]' => 'Survey admin',
  '[[.question.]]' => 'Question',
  '[[.Cancel.]]' => 'Cancel',
  '[[.multi_is_select.]]' => 'Multi is select',
  '[[.survey_options.]]' => 'Survey options',
  '[[.position.]]' => 'Position',
  '[[.count.]]' => 'Count',
  '[[.invalid_question.]]' => 'Invalid question',
  '[[.select_other_survey.]]' => 'Chọn bình chọn khác',
  '[[.Survey.]]' => 'Survey',
  '[[.admin_survey.]]' => 'Quản lý bình chọn',
  '[[.result.]]' => 'Kết quả',
  '[[.vote.]]' => 'Bình chọn',
  '[[.total_number.]]' => 'Tổng số',
  '[[.voting_paper.]]' => 'Trang bình chọn',
  '[[.delete_confirm_question.]]' => 'Delete confirm question',
  '[[.module_words_of.]]' => 'Module words of',
  '[[.all_words.]]' => 'All words',
  '[[.value.]]' => 'Value',
  '[[.time.]]' => 'Thời gian',
  '[[.invalid_content.]]' => 'Lỗi nhập nội dung',
  '[[.invalid_poster.]]' => 'Lỗi nhập người gửi',
  '[[.no_result.]]' => 'Chưa có kết quả',
  '[[.update_image_url.]]' => 'Update image url',
  '[[.SEO_config.]]' => 'SEO config',
  '[[.website_keywords.]]' => 'Website keywords',
  '[[.website_description.]]' => 'Website description',
  '[[.google_analytics.]]' => 'Google analytics',
  '[[.language.]]' => 'Language',
  '[[.code.]]' => 'Code',
  '[[.day.]]' => 'Day',
  '[[.month.]]' => 'Month',
  '[[.Search_Hotels.]]' => 'Search Hotels',
  '[[.Hotel_name.]]' => 'Hotel name',
  '[[.Check_in_date.]]' => 'Check in date',
  '[[.Check_out_date.]]' => 'Check out date',
  '[[.no_data_matchs.]]' => 'No data matchs',
  '[[.no_result_matchs.]]' => 'Không có kết quả phù hợp',
  '[[.please_enter_at_least_2_characters.]]' => 'Làm ơn nhập tối thiểu 2 ký tự',
  '[[.invalid_username_or_password.]]' => 'Invalid username or password',
  '[[.Are_you_sure_to_add_reservation.]]' => 'Are you sure to add reservation',
  '[[.recover_password.]]' => 'Recover password',
  '[[.Your_email.]]' => 'Your email',
  '[[.content_forgot_password.]]' => 'Content forgot password',
  '[[.invalid_user_id.]]' => 'Invalid user id',
  '[[.invalid_email.]]' => 'Lỗi nhập email',
  '[[.bed_content.]]' => 'Nội dung bạn đăng có từ "quá Sốc", không đỡ nổi, vui lòng thay từ khác *.*',
  '[[.bed_word_list.]]' => 'Bed word list',
  '[[.regular_expression.]]' => 'Regular expression',
  '[[.news_category.]]' => 'News category',
  '[[.poster.]]' => 'Poster',
  '[[.manage_profile.]]' => 'Quản lý hồ sơ',
  '[[.personal.]]' => 'Personal',
  '[[.Change_pass.]]' => 'Đổi mật khẩu',
  '[[.Edit_pass.]]' => 'Đổi mật khẩu',
  '[[.change_information_user.]]' => 'Thay đổi thông tin cá nhân',
  '[[.full_name.]]' => 'Họ và tên',
  '[[.address.]]' => 'Địa chỉ',
  '[[.Country.]]' => 'Quốc gia',
  '[[.gender.]]' => 'Giới tính',
  '[[.birth_date.]]' => 'Ngày sinh',
  '[[.Passport.]]' => 'Hộ chiếu/CMT',
  '[[.phone_number.]]' => 'Số điện thoại',
  '[[.mobile_phone.]]' => 'Số di động',
  '[[.fax.]]' => 'Fax',
  '[[.yahoo.]]' => 'Yahoo',
  '[[.email.]]' => 'Email',
  '[[.website.]]' => 'Website',
  '[[.information_contact.]]' => 'Thông tin liên hệ',
  '[[.avatar.]]' => 'Avatar',
  '[[.like.]]' => 'Like',
  '[[.right_not_modify.]]' => 'Chuẩn không cần chỉnh',
  '[[.right.]]' => 'Chuẩn',
  '[[.you_have_just_liked_this.]]' => 'Bạn vừa mới chuẩn xong',
  '[[.user_admin.]]' => 'User admin',
  '[[.user_name.]]' => 'User name',
  '[[.is_active.]]' => 'Is active',
  '[[.join_date.]]' => 'Join date',
  '[[.zone.]]' => 'Zone',
  '[[.privilege.]]' => 'Privilege',
  '[[.male.]]' => 'Male',
  '[[.female.]]' => 'Female',
  '[[.information.]]' => 'Thông tin',
  '[[.password.]]' => 'Password',
  '[[.active.]]' => 'Active',
  '[[.block.]]' => 'Block',
  '[[.view.]]' => 'View',
  '[[.miss_content_or_larger_than_1000.]]' => 'Chưa nhập nội dung hoặc nội dung lớn hơn 1000 ký tự',
  '[[.photo_category.]]' => 'Photo category',
  '[[.manage_media.]]' => 'Manage media',
  '[[.photo_admin.]]' => 'Photo admin',
  '[[.Slide_list.]]' => 'Slide list',
  '[[.Make_slide.]]' => 'Make slide',
  '[[.Go.]]' => 'Go',
  '[[.category_id.]]' => 'Category id',
  '[[.all_category.]]' => 'All category',
  '[[.add.]]' => 'Add',
  '[[.Preview.]]' => 'Preview',
  '[[.Rating.]]' => 'Rating',
  '[[.Hitcount.]]' => 'Hitcount',
  '[[.Created.]]' => 'Created',
  '[[.Modified.]]' => 'Modified',
  '[[.Parameters_properties.]]' => 'Parameters properties',
  '[[.Metadata_information.]]' => 'Metadata information',
  '[[.keywords.]]' => 'Keywords',
  '[[.tags.]]' => 'Tags',
  '[[.update_success_are_you_continous.]]' => 'Update success are you continous',
  '[[.Poster.]]' => 'Poster',
  '[[.up_time.]]' => 'Up time',
  '[[.email_is_not_registed.]]' => 'Email is not registed',
  '[[.component_manage_hotel.]]' => 'Component manage hotel',
  '[[.you_have_to_input_email.]]' => 'Bạn phải nhập email',
  '[[.please_enter_a_valid_email_address.]]' => 'Bạn hãy nhập email đúng định dạng',
  '[[.utils.]]' => 'Utils',
  '[[.country_admin.]]' => 'Country admin',
  '[[.are_you_want_to_delete.]]' => 'Are you want to delete',
  '[[.Module_settings.]]' => 'Module settings',
  '[[.module_name.]]' => 'Module name',
  '[[.go_to_page.]]' => 'Go to page',
  '[[.Add_module_setting.]]' => 'Add module setting',
  '[[.help.]]' => 'Help',
  '[[.module_id.]]' => 'Module id',
  '[[.default_value.]]' => 'Default value',
  '[[.value_list.]]' => 'Value list',
  '[[.edit_condition.]]' => 'Edit condition',
  '[[.view_condition.]]' => 'View condition',
  '[[.extend.]]' => 'Extend',
  '[[.group_column.]]' => 'Group column',
  '[[.meta.]]' => 'Meta',
  '[[.update_code.]]' => 'Update code',
  '[[.Edit_module_setting.]]' => 'Edit module setting',
  '[[.undefined.]]' => 'Undefined',
  '[[.publisher.]]' => 'Publisher',
  '[[.last_time_update.]]' => 'Last time update',
  '[[.items.]]' => 'Items',
  '[[.content_admin.]]' => 'Content admin',
  '[[.category.]]' => 'Category',
  '[[.faq_admin.]]' => 'Faq admin',
  '[[.advertisment_admin.]]' => 'Advertisment admin',
  '[[.clip_admin.]]' => 'Clip admin',
  '[[.manage_contact.]]' => 'Quản lý liên hệ',
  '[[.stt.]]' => 'Stt',
  '[[.subject.]]' => 'Chủ đề',
  '[[.detail.]]' => 'Chi tiết',
  '[[.System_manage.]]' => 'System manage',
  '[[.grant_privilege.]]' => 'Grant privilege',
  '[[.user.]]' => 'User',
  '[[.go.]]' => 'Go',
  '[[.account_id.]]' => 'Account id',
  '[[.grant.]]' => 'Grant',
  '[[.portal_id.]]' => 'Portal id',
  '[[.currency_admin.]]' => 'Currency admin',
  '[[.Update.]]' => 'Update',
  '[[.exchange.]]' => 'Exchange',
  '[[.month_1.]]' => 'Month 1',
  '[[.month_2.]]' => 'Month 2',
  '[[.month_3.]]' => 'Month 3',
  '[[.month_4.]]' => 'Month 4',
  '[[.month_5.]]' => 'Month 5',
  '[[.month_6.]]' => 'Month 6',
  '[[.month_7.]]' => 'Month 7',
  '[[.month_8.]]' => 'Month 8',
  '[[.month_9.]]' => 'Month 9',
  '[[.month_10.]]' => 'Month 10',
  '[[.month_11.]]' => 'Month 11',
  '[[.month_12.]]' => 'Month 12',
  '[[.statistic.]]' => 'Statistic',
  '[[.user_online.]]' => 'User online',
  '[[.date_page_view.]]' => 'Date page view',
  '[[.month_page_view.]]' => 'Month page view',
  '[[.year_page_view.]]' => 'Year page view',
  '[[.total_page_view.]]' => 'Total page view',
  '[[.chart_statistis.]]' => 'Chart statistis',
  '[[.page_view_day_in_month.]]' => 'Page view day in month',
  '[[.year.]]' => 'Year',
  '[[.page_view.]]' => 'Page view',
  '[[.Ip.]]' => 'Ip',
  '[[.Client.]]' => 'Client',
  '[[.country.]]' => 'Country',
  '[[.on_page.]]' => 'On page',
  '[[.top_of_daily_news.]]' => 'Top of daily news',
  '[[.statistic_advertisment.]]' => 'Statistic advertisment',
  '[[.List_adv.]]' => 'List adv',
  '[[.start_date.]]' => 'Start date',
  '[[.end_date.]]' => 'End date',
  '[[.count_click.]]' => 'Count click',
  '[[.region.]]' => 'Region',
  '[[.have.]]' => 'Have',
  '[[.advertisments.]]' => 'Advertisments',
  '[[.function_edit.]]' => 'Function edit',
  '[[.1.]]' => '1',
  '[[.dupplicated_code.]]' => 'Dupplicated code',
  '[[.Change_password.]]' => 'Đổi mật khẩu',
  '[[.Information.]]' => 'Thông tin',
  '[[.old_password.]]' => 'Mật khẩu cũ',
  '[[.new_password.]]' => 'Mật khẩu mới',
  '[[.retype_new_password.]]' => 'Nhập lại mật khẩu mới',
  '[[.manage_advertisment.]]' => 'Manage advertisment',
  '[[.start_time.]]' => 'Start time',
  '[[.end_time.]]' => 'End time',
  '[[.select_city.]]' => 'Select city',
  '[[.zone_admin.]]' => 'Zone admin',
  '[[.city.]]' => 'City',
  '[[.latitude.]]' => 'Latitude',
  '[[.longitude.]]' => 'Longitude',
  '[[.control_panel.]]' => 'Control panel',
  '[[.List.]]' => 'List',
  '[[.Grant.]]' => 'Grant',
  '[[.function_name.]]' => 'Function name',
  '[[.Back.]]' => 'Back',
  '[[.privilege_id.]]' => 'Privilege id',
  '[[.multiple_item.]]' => 'Multiple item',
  '[[.Moderator.]]' => 'Moderator',
  '[[.reserve.]]' => 'Reserve',
  '[[.admin.]]' => 'Admin',
  '[[.hot_news.]]' => 'Hot news',
  '[[.news.]]' => 'News',
  '[[.news_and_event.]]' => 'News and event',
  '[[.updated.]]' => 'Updated',
  '[[.related_news.]]' => 'Related news',
  '[[.brief.]]' => 'Brief',
  '[[.Status.]]' => 'Status',
  '[[.images.]]' => 'Images',
  '[[.small_thumb.]]' => 'Small thumb',
  '[[.attach_file.]]' => 'Attach file',
  '[[.Parameters_article.]]' => 'Parameters article',
  '[[.author.]]' => 'Author',
  '[[.show_image_in_detail.]]' => 'Show image in detail',
  '[[.pdf_icon.]]' => 'Pdf icon',
  '[[.print_icon.]]' => 'Print icon',
  '[[.email_icon.]]' => 'Email icon',
  '[[.show_time.]]' => 'Show time',
  '[[.show_author.]]' => 'Show author',
  '[[.show_comment.]]' => 'Show comment',
  '[[.Total_item.]]' => 'Total item',
  '[[.use_price.]]' => 'Use price',
  '[[._category.]]' => ' category',
  '[[.system_info.]]' => 'System info',
  '[[.PHP_core.]]' => 'PHP core',
  '[[.PHP_configs.]]' => 'PHP configs',
  '[[.apache2handler.]]' => 'Apache2handler',
  '[[.Apache_environment.]]' => 'Apache environment',
  '[[.Graph_driver.]]' => 'Graph driver',
  '[[.mysql.]]' => 'Mysql',
  '[[.session.]]' => 'Session',
  '[[.System_info.]]' => 'System info',
  '[[.content_category.]]' => 'Content category',
  '[[.select_relation_type.]]' => 'Select relation type',
  '[[.father.]]' => 'Father',
  '[[.mother.]]' => 'Mother',
  '[[.married.]]' => 'Married',
  '[[.engage.]]' => 'Engage',
  '[[.relationship.]]' => 'Relationship',
  '[[.separated.]]' => 'Separated',
  '[[.divorced.]]' => 'Divorced',
  '[[.partners.]]' => 'Partners',
  '[[.contact.]]' => 'Contact',
  '[[.biographical.]]' => 'Biographical',
  '[[.first_name.]]' => 'First name',
  '[[.middle_name.]]' => 'Middle name',
  '[[.surnname.]]' => 'Surnname',
  '[[.home_name.]]' => 'Home name',
  '[[.death_date.]]' => 'Death date',
  '[[.alive.]]' => 'Alive',
  '[[.partner.]]' => 'Partner',
  '[[.wedding_date.]]' => 'Wedding date',
  '[[.location.]]' => 'Location',
  '[[.engagement_date.]]' => 'Engagement date',
  '[[.separation_date.]]' => 'Separation date',
  '[[.engaged.]]' => 'Engaged',
  '[[.devorce_date.]]' => 'Devorce date',
  '[[.required.]]' => 'Required',
  '[[.at_least_three_letters.]]' => 'At least three letters',
  '[[.maximum_three_letters.]]' => 'Maximum three letters',
  '[[.choose_folder.]]' => 'Choose folder',
  '[[.email_template_admin.]]' => 'Email template admin',
  '[[.folder.]]' => 'Folder',
  '[[.preview.]]' => 'Preview',
  '[[.surname.]]' => 'Surname',
  '[[.add_parent.]]' => 'Add parent',
  '[[.add_child.]]' => 'Add child',
  '[[.add_partner.]]' => 'Add partner',
  '[[.father_of.]]' => 'Father of',
  '[[.mother_of.]]' => 'Mother of',
  '[[.partner_of.]]' => 'Partner of',
  '[[.add_wife.]]' => 'Add wife',
  '[[.child_of.]]' => 'Child of',
  '[[.contactus_by_email.]]' => 'Contactus by email',
  '[[.miss_full_name.]]' => 'Chưa nhập họ và tên',
  '[[.miss_phone.]]' => 'Chưa nhập điện thoại',
  '[[.invalid_full_name.]]' => 'Lỗi nhập họ và tên',
  '[[.miss_address.]]' => 'Chưa nhập địa chỉ',
  '[[.miss_ship_full_name.]]' => 'Chưa nhập họ và tên (Địa chỉ chuyển hàng)',
  '[[.miss_ship_phone.]]' => 'Chưa nhập số điện thoại (Địa chỉ chuyển hàng)',
  '[[.invalid_ship_email.]]' => 'Lỗi nhập email (Địa chỉ chuyển hàng)',
  '[[.miss_ship_address.]]' => 'Lỗi nhập địa chỉ  (Địa chỉ chuyển hàng)',
  '[[.miss_zone.]]' => 'Chưa nhập tỉnh/TP',
  '[[.miss_ship_zone.]]' => 'Chưa nhập tỉnh/TP (Địa chỉ chuyển hàng)',
  '[[.edit_item.]]' => 'Edit item',
  '[[.contact_detail.]]' => 'Chi tiết liên hệ',
  '[[.is_check.]]' => 'Đã kiểm tra',
  '[[.name_sender.]]' => 'Name sender',
  '[[.hotel_name.]]' => 'Hotel name',
  '[[.sender.]]' => 'Người gửi',
  '[[.manage_zone.]]' => 'Manage zone',
  '[[.customer_service_admin.]]' => 'Customer service admin',
  '[[.phone.]]' => 'Phone',
  '[[.service.]]' => 'Service',
  '[[.manage_newsletter.]]' => 'Quản lý tin thư',
  '[[.newsletter_list.]]' => 'Danh sách tin thư',
  '[[.total_amount.]]' => 'Total amount',
  '[[.manage_order.]]' => 'Manage order',
  '[[.invalid_old_password.]]' => 'Lỗi nhập mật khẩu cũ',
  '[[.invalid_new_password.]]' => 'Lỗi nhập mật khẩu mới',
  '[[.invalid_retype_password.]]' => 'Lỗi nhập nhập lại mật khẩu',
  '[[.retype_password.]]' => 'Nhập lại mật khẩu',
  '[[.invalid_address.]]' => 'Lỗi nhập địa chỉ',
  '[[.invalid_phone_number.]]' => 'Lỗi nhập số điện thoại',
  '[[.email_invalid.]]' => 'Lỗi nhập email',
  '[[.price.]]' => 'Price',
  '[[.unlink.]]' => 'Unlink',
  '[[.field_name.]]' => 'Field name',
  '[[.fetch_now.]]' => 'Fetch now',
  '[[.link_no_exists.]]' => 'Link no exists',
  '[[.fetch_category.]]' => 'Fetch category',
  '[[.invalid_url.]]' => 'Invalid url',
  '[[.all_passed.]]' => 'All passed',
  '[[.not_passed.]]' => 'Not passed',
  '[[.passed.]]' => 'Passed',
  '[[.all_account.]]' => 'All account',
  '[[.manage_promotion.]]' => 'Manage promotion',
  '[[.hotel.]]' => 'Hotel',
  '[[.create_date.]]' => 'Create date',
  '[[.Choose.]]' => 'Choose',
  '[[.discount_room_rates.]]' => 'Discount room rates',
  '[[.Free_room_night.]]' => 'Free room night',
  '[[.discount_pickup.]]' => 'Discount pickup',
  '[[.discount_service.]]' => 'Discount service',
  '[[.early_bird.]]' => 'Early bird',
  '[[.name_of_promotion.]]' => 'Name of promotion',
  '[[.content_of_promotion.]]' => 'Content of promotion',
  '[[.expired.]]' => 'Expired',
  '[[.miss_quantity.]]' => 'Miss quantity',
  '[[.miss_value.]]' => 'Miss value',
  '[[.miss_rand_code_quantity.]]' => 'Miss rand code quantity',
  '[[.miss_promotion_value.]]' => 'Miss promotion value',
  '[[.not_pass_yet.]]' => 'Not pass yet',
  '[[.miss_name.]]' => 'Miss name',
  '[[.product_unit.]]' => 'Product unit',
  '[[.discard.]]' => 'Discard',
  '[[.normal_unit.]]' => 'Normal unit',
  '[[.add_item.]]' => 'Add item',
  '[[.normal_item_maker.]]' => 'Normal item maker',
  '[[.miss_model.]]' => 'Miss model',
  '[[.miss_description.]]' => 'Miss description',
  '[[.duplicate_name.]]' => 'Duplicate name',
  '[[.advertisment.]]' => 'Advertisment',
  '[[.chose_page.]]' => 'Chose page',
  '[[.list_advertisment.]]' => 'List advertisment',
  '[[.width.]]' => 'Width',
  '[[.height.]]' => 'Height',
  '[[.invalid_user.]]' => 'Invalid user',
  '[[.miss_item_id.]]' => 'Miss item id',
  '[[.miss_item_name.]]' => 'Miss item name',
  '[[.all.]]' => 'All',
  '[[.function.]]' => 'Function',
  '[[.invalid_name.]]' => 'Invalid name',
  '[[.parent_folder.]]' => 'Parent folder',
  '[[.create_folder.]]' => 'Create folder',
  '[[.upload_image.]]' => 'Upload image',
  '[[.rename.]]' => 'Rename',
  '[[.this_function_is_locking.]]' => 'This function is locking',
  '[[.Are_you_want_to_delete_this_file.]]' => 'Are you want to delete this file',
  '[[.You_must_select_file_before_upload.]]' => 'You must select file before upload',
  '[[.manage_log.]]' => 'Manage log',
  '[[.from_date.]]' => 'From date',
  '[[.to_date.]]' => 'To date',
  '[[.param.]]' => 'Param',
  '[[.video_category.]]' => 'Video category',
  '[[.video_admin.]]' => 'Video admin',
  '[[.invalid_name_1.]]' => 'Invalid name 1',
  '[[.thumb.]]' => 'Thumb',
  '[[.website_title.]]' => 'Website title',
  '[[.keyword.]]' => 'Keyword',
  '[[.quote.]]' => 'Quote',
  '[[.zone_parent.]]' => 'Zone parent',
  '[[.view_map.]]' => 'View map',
  '[[.select_map.]]' => 'Select map',
  '[[.radius.]]' => 'Radius',
  '[[.map.]]' => 'Map',
  '[[.Flag.]]' => 'Flag',
  '[[.you_must_select_privilege_id.]]' => 'You must select privilege id',
  '[[.invalid_parent.]]' => 'Invalid parent',
  '[[.cmtnd.]]' => 'Cmtnd',
  '[[.backup_data.]]' => 'Backup data',
  '[[.Backup.]]' => 'Backup',
  '[[.table_name.]]' => 'Table name',
  '[[.Engine.]]' => 'Engine',
  '[[.Version.]]' => 'Version',
  '[[.Row_format.]]' => 'Row format',
  '[[.Rows.]]' => 'Rows',
  '[[.Avg_row_length.]]' => 'Avg row length',
  '[[.Data_length.]]' => 'Data length',
  '[[.Max_data_length.]]' => 'Max data length',
  '[[.Index_length.]]' => 'Index length',
  '[[.Auto_increment.]]' => 'Auto increment',
  '[[.Create_time.]]' => 'Create time',
  '[[.Update_time.]]' => 'Update time',
  '[[.Total.]]' => 'Total',
  '[[.first_name_invalid.]]' => 'First name invalid',
  '[[.Utils_other.]]' => 'Utils other',
  '[[.weather.]]' => 'Weather',
  '[[.golden_exchange.]]' => 'Golden exchange',
  '[[.currency.]]' => 'Currency',
  '[[.sell.]]' => 'Sell',
  '[[.buy.]]' => 'Buy',
  '[[.province.]]' => 'Province',
  '[[.temperature.]]' => 'Temperature',
  '[[.duplicate_title.]]' => 'Duplicate title',
  '[[.page_name.]]' => 'Page name',
  '[[.page_list.]]' => 'Page list',
  '[[.invalid_birth_date.]]' => 'Invalid birth date',
  '[[.invalid_category_id.]]' => 'Invalid category id',
  '[[.move.]]' => 'Move',
  '[[.invalid_end_time.]]' => 'Invalid end time',
  '[[.invalid_start_time.]]' => 'Invalid start time',
  '[[.invalid_region.]]' => 'Invalid region',
  '[[.System_management.]]' => 'System management',
  '[[.manage_recyclebin.]]' => 'Manage recyclebin',
  '[[.are_you_sure_empty.]]' => 'Are you sure empty',
  '[[.empty.]]' => 'Empty',
  '[[.select_each_item_below_to_restore.]]' => 'Select each item below to restore',
  '[[.name_or_email_is_registered.]]' => 'Name or email is registered',
  '[[.user_not_actived.]]' => 'User not actived',
  '[[.Tên đăng nhập hoặc email đã được đăng ký.]]' => 'Tên đăng nhập hoặc email đã được đăng ký',
  '[[.content_invalid.]]' => 'Content invalid',
  '[[.manage_game.]]' => 'Manage game',
  '[[.game_category.]]' => 'Game category',
  '[[.Trùng tiêu đề với bài viết khác!.]]' => 'Trùng tiêu đề với bài viết khác!',
  '[[.Email này chưa đăng ký..]]' => 'Email này chưa đăng ký.',
  '[[.invalid_name_2.]]' => 'Invalid name 2',
  '[[.Bạn vui lòng nhập nội dung trên 10 ký tự và không quá 2000 ký tự..]]' => 'Bạn vui lòng nhập nội dung trên 10 ký tự và không quá 2000 ký tự.',
  '[[.Lỗi nhập tiêu đề bài viết.]]' => 'Lỗi nhập tiêu đề bài viết',
  '[[.all_city.]]' => 'All city',
  '[[.Email_refer.]]' => 'Email refer',
  '[[.Nội dung của bạn có chứa từ không thuần phong mỹ tục. Vui lòng kiểm tra lại.]]' => 'Nội dung của bạn có chứa từ không thuần phong mỹ tục. Vui lòng kiểm tra lại',
  '[[.Vòng đấu đã kết thúc. Bạn vui lòng đợi lần mở vòng tiếp theo để bình chọ.]]' => 'Vòng đấu đã kết thúc. Bạn vui lòng đợi lần mở vòng tiếp theo để bình chọn!',
  '[[.select_folder.]]' => 'Select folder',
  '[[.restore_date.]]' => 'Restore date',
  '[[.Restore.]]' => 'Restore',
  '[[.last_modified.]]' => 'Last modified',
  '[[.file_size.]]' => 'File size',
  '[[.invalid_password.]]' => 'Invalid password',
  '[[.Server đã đủ 10 đội. Bạn vui lòng chọn server khách.]]' => 'Server đã đủ 10 đội. Bạn vui lòng chọn server khách',
  '[[.last_name_invalid.]]' => 'Last name invalid',
  '[[.Tên CLB đã có người khác sử dụng, bạn vui lòng chọn tên khác..]]' => 'Tên CLB đã có người khác sử dụng, bạn vui lòng chọn tên khác.',
  '[[.password_retype_is_not_true.]]' => 'Password retype is not true',
  '[[.Lỗi nhập tên câu lạc bộ.]]' => 'Lỗi nhập tên câu lạc bộ',
  '[[.Bạn không đủ số iGold..]]' => 'Bạn không đủ số iGold.',
  '[[.Tên của bạn đặt có chứa từ không thuần phong mỹ tục. Vui lòng kiểm tra lại.]]' => 'Tên của bạn đặt có chứa từ không thuần phong mỹ tục. Vui lòng kiểm tra lại',
  '[[.Are_you_sure.]]' => 'Are you sure',
  '[[.product.]]' => 'Product',
  '[[.promotion_price.]]' => 'Promotion price',
);
}
?>