/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 * Tích hợp và hướng dẫn bởi https://trungtrinh.com - Website chia sẻ bách khoa toàn thư */
 var base_url = window.location.origin;


CKEDITOR.editorConfig = function( config ) {
    config.filebrowserBrowseUrl = base_url + '/admin/libs/ckeditor/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = base_url + '/admin/libs/ckeditor/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = base_url + '/admin/libs/ckeditor/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = base_url +'/admin/libs/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = base_url +'/admin/libs/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = base_url +'/admin/libs/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
