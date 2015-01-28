<?php
 define('TEXT_PRODUCTS_COST_INFO', 'Cost: ');
 define('TEXT_PRODUCTS_PROFIT_INFO', 'Profit:');
 define('TEXT_PRODUCTS_PRICE_COST', 'Products Price (Cost):');
//
define('ENTRY_PRODUCTS_PRICE', 'Product Price #');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'disabled');
//

// multi images
define('TEXT_PRODUCTS_IMAGE_EXTRA', 'Products Extra Image #');
define('TEXT_DELETE_IMAGE', 'Delete image');

define('HEADING_TITLE', 'Categorias / Produtos');
define('HEADING_TITLE_SEARCH', 'Procurar:');
define('HEADING_TITLE_GOTO', 'Ir para:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorias / Produtos');
define('TABLE_HEADING_ACTION', 'Ac&ccedil;&atilde;o');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_EVIDENCE_STATUS', 'Evidence');

define('TEXT_NEW_PRODUCT', 'Novo Produto em &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categorias:');
define('TEXT_SUBCATEGORIES', 'Subcategorias:');
define('TEXT_PRODUCTS', 'Produtos:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Pre&ccedil;o:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Classe de Imposto:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Classifica&ccedil;&atilde;o M&eacute;dia:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantidade:');
define('TEXT_DATE_ADDED', 'Adicionada em:');
define('TEXT_DATE_AVAILABLE', 'Dispon&iacute;vel em:');
define('TEXT_LAST_MODIFIED', '&Uacute;ltima altera&ccedil;&atilde;o:');
define('TEXT_IMAGE_NONEXISTENT', 'A IMAGEM N&Atilde;O EXISTE');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Insira uma nova categoria ou produto neste n&iacute;vel s.f.f.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Para mais informa&ccedil;&atilde;o veja a <a href="http://%s" target="blank"><u>p&aacute;gina</u></a> deste produto.');
define('TEXT_PRODUCT_DATE_ADDED', 'Este produto fou adicionado ao nosso cat&aacute;logo em %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este produto estar&aacute; dispon&iacute;vel em %s.');

define('TEXT_EDIT_INTRO', 'Por favor efectue as altera&ccedil;&otilde;es necess&aacute;rias');
define('TEXT_EDIT_CATEGORIES_ID', 'ID da Categoria:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nome da Categoria:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Imagem da Categoria:');
define('TEXT_EDIT_SORT_ORDER', 'Ordem:');

define('TEXT_INFO_COPY_TO_INTRO', 'Escolha uma nova categoria para a qual copiar este produto.');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorias actuais:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nova Categoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar Categoria');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Apagar Categoria');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categoria');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Apagar Produto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Produto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar para');

define('TEXT_DELETE_CATEGORY_INTRO', 'Tem a certeza de que quer apagar esta categoria?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Tem a certeza de que quer apagar permanentemente este produto?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>AVISO:</b> Ainda existem %s (sub)categorias ligadas a esta categoria!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>AVISO:</b> Ainda existem %s produtos ligados a esta categoria!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Por favor <b>%s</b> escolha a categoria a que quer pertencer');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Por favor <b>%s</b> escolha a categoria a que quer pertencer');
define('TEXT_MOVE', 'Mover <b>%s</b> para:');

define('TEXT_NEW_CATEGORY_INTRO', 'Por favor preencha a seguinte informa&ccedil;&atilde;o para a nova categoria');
define('TEXT_CATEGORIES_NAME', 'Nome da Categoria:');
define('TEXT_CATEGORIES_IMAGE', 'Imagem da Categoria:');
define('TEXT_SORT_ORDER', 'Ordem:');

define('TEXT_PRODUCTS_STATUS', 'Estado dos Produtos:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Dispon&iacute;vel em:');
define('TEXT_PRODUCT_AVAILABLE', 'Dispon&iacute;vel');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Esgotado');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante:');
define('TEXT_PRODUCTS_NAME', 'Nome do Produto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descri&ccedil;&atilde;o do Produto:');
define('TEXT_PRODUCTS_QUANTITY', 'Quantidade do Produto:');
define('TEXT_PRODUCTS_MODEL', 'Modelo do Produto:');
define('TEXT_PRODUCTS_IMAGE', 'Imagem do Produto:');
define('TEXT_PRODUCTS_URL', 'URL do Produto:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sem http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Pre&ccedil;o do Produto (Il&iacute;quido):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Pre&ccedil;o do Produto (L&iacute;quido):');
define('TEXT_PRODUCTS_WEIGHT', 'Peso do Produto:');

define('EMPTY_CATEGORY', 'Categoria Vazia');

define('TEXT_HOW_TO_COPY', 'M&eacute;todo de c&oacute;pia:');
define('TEXT_COPY_AS_LINK', 'Liga&ccedil;&atilde;o ao produto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplica&ccedil;&atilde;o do Produto');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Erro: N&atilde;o pode ligar produtos na mesma categoria!');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erro: A pasta das imagens do cat&aacute;logo n&atilde;o pode ser escrita: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erro: A pasta das imagens do cat&aacute;logo n&atilde;o existe: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Erro: A categoria n&atilde;o pode ser movida para uma subcategoria!');
define('TEXT_EDIT_STATUS', 'Status Category');
define('TEXT_CATEGORIES_DESC', 'Description category');

  define('TEXT_PRODUCTS_HEIGHT', 'Height:');
  define('TEXT_PRODUCTS_LENGTH', 'Length:');
  define('TEXT_PRODUCTS_WIDTH', 'Width:');
  define('TEXT_PRODUCTS_READY_TO_SHIP', 'Ready to ship:');
  define('TEXT_PRODUCTS_READY_TO_SHIP_SELECTION', 'Product can be shipped in its own container.');
  define('TEXT_PRODUCTS_CODEBAR', 'CODE-BAR:');

  define('TEXT_PRODUCTS_RSS', 'Add this article "out" (it will appear in the box at the top of homepage)');

  define('TEXT_PRODUCTS_ATTRIBUTE_BOX', 'Size and weight including packaging article: (WARNING: the values are used for the calculation of transport!) <br /> NB.utile if they would be sealed in blister or if they are included its own package. ');
  define('TEXT_PRODUCTS_INFO_WEIGHT', 'Product weight without packaging:');
  define('TEXT_PRODUCTS_INFO_LENGTH', 'Length of the product without packaging:');
  define('TEXT_PRODUCTS_INFO_WIDTH', 'Depth of the product without packaging:');
  define('TEXT_PRODUCTS_INFO_HEIGHT', 'Height of the product without packaging:');
  define('TEXT_PRODUCTS_ATTRIBUTE_INFO', 'part dimensions and weights without packaging: <br /> NB. If you do not put a value will be taken into account the value of the package above');

define('TEXT_EXTRA_FIELDS', 'If any of the following extra fields do not apply to this product leave them blank if it is a text or checkbox field or set to &ldquo;Does Not Apply&rdquo; if it is a drop down list or radio button field.');
?>