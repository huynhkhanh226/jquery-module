tableExport.jquery.plugin
=========================

<h3>Export HTML Table to</h3>
<ul>
<li> CSV
<li> DOC
<li> JSON
<li> PDF
<li> PNG
<li> SQL
<li> TSV
<li> TXT
<li> XLS   (Excel 2000 HTML format)
<li> XLSX  (Excel 2007 Office Open XML format)
<li> XML   (Excel 2003 XML Spreadsheet format)
<li> XML   (Raw xml)
</ul>

Installation
============

To save the generated export files on client side, include in your html code:

```javascript
<script type="text/javascript" src="libs/FileSaver/FileSaver.min.js"></script>
```

To export the table in XLSX (Excel 2007+ XML Format) format, you need to include additionally:
```javascript
<script type="text/javascript" src="libs/js-xlsx/xlsx.core.min.js"></script>
```

To export the table as a PDF file the following includes are required:

```javascript
<script type="text/javascript" src="libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
```

To export the table in PNG format, you need to include:

```javascript
<script type="text/javascript" src="libs/html2canvas/html2canvas.min.js"></script>
```

Regardless of the desired format, finally include:

```javascript
<script type="text/javascript" src="tableExport.min.js"></script>
```

Please keep this include order.



Dependencies
============

Library | Version
--------|--------
[jQuery](https://github.com/jquery/jquery) | >= 1.9.1
[FileSaver](https://github.com/hhurz/tableExport.jquery.plugin/blob/master/libs/FileSaver/FileSaver.min.js) | >= 1.2.0
[html2canvas](https://github.com/niklasvh/html2canvas) | >= 0.5.0-beta4
[jsPDF](https://github.com/MrRio/jsPDF) | 1.1.239 or 1.3.2
[jsPDF-AutoTable](https://github.com/simonbengtsson/jsPDF-AutoTable) | 2.0.14 or 2.0.17




Examples
========

```javascript
// CSV format

$('#tableID').tableExport({type:'csv'});
```

```javascript
// Excel 2000 html format

$('#tableID').tableExport({type:'excel'});
```

https://github.com/hhurz/tableExport.jquery.plugin

```javascript
// XML Spreadsheet 2003 file format with multiple worksheet support

$('table').tableExport({type:'excel',
                        excelFileFormat:'xmlss',
                        worksheetName: ['Table 1','Table 2', 'Table 3']});
```

```javascript
// PDF export using jsPDF only

$('#tableID').tableExport({type:'pdf',
                           jspdf: {orientation: 'p',
                                   margins: {left:20, top:10},
                                   autotable: false}
                          });
```

```javascript
// PDF format using jsPDF and jsPDF Autotable 

$('#tableID').tableExport({type:'pdf',
                           jspdf: {orientation: 'l',
                                   format: 'a3',
                                   margins: {left:10, right:10, top:20, bottom:20},
                                   autotable: {styles: {fillColor: 'inherit', 
                                                        textColor: 'inherit'},
                                               tableWidth: 'auto'}
                                  }
                          });
```

```javascript
// PDF format with callback example

function DoCellData(cell, row, col, data) {}
function DoBeforeAutotable(table, headers, rows, AutotableSettings) {}

$('table').tableExport({fileName: sFileName,
                        type: 'pdf',
                        jspdf: {format: 'bestfit',
                                margins: {left:20, right:10, top:20, bottom:20},
                                autotable: {styles: {overflow: 'linebreak'},
                                            tableWidth: 'wrap',
                                            tableExport: {onBeforeAutotable: DoBeforeAutotable,
                                                          onCellData: DoCellData}}}
                       });
```

Options (Default settings)
=======

```javascript
consoleLog: false
csvEnclosure: '"'
csvSeparator: ','
csvUseBOM: true
displayTableName: false
escape: false
excelRTL: false
excelstyles: []
excelFileFormat: 'xlshtml'
exportHiddenCells: false
fileName: 'tableExport'
htmlContent: false
ignoreColumn: []
ignoreRow: []
jsonScope: 'all'
jspdf: orientation: 'p'
       unit:'pt'
       format: 'a4'
       margins: left: 20
                right: 10
                top: 10
                bottom: 10
       onDocCreated: null
       autotable: styles: cellPadding: 2
                          rowHeight: 12
                          fontSize: 8
                          fillColor: 255
                          textColor: 50
                          fontStyle: 'normal'
                          overflow: 'ellipsize'
                          halign: 'left'
                          valign: 'middle'
                  headerStyles: fillColor: [52, 73, 94]
                                textColor: 255
                                fontStyle: 'bold'
                                halign: 'center'
                  alternateRowStyles: fillColor: 245
                  tableExport: doc: null
                               onAfterAutotable: null
                               onBeforeAutotable: null
                               onAutotableText: null
                               onTable: null
                               outputImages: true
numbers: html: decimalMark: '.'
               thousandsSeparator: ','
         output: decimalMark: '.',
                 thousandsSeparator: ','
onCellData: null
onCellHtmlData: null
onIgnoreRow: null
onMsoNumberFormat: null
outputMode: 'file'
pdfmake: enabled: false
         docDefinition: pageOrientation: 'portrait'
                        defaultStyle: font: 'Roboto'
         fonts: {}
tbodySelector: 'tr'
tfootSelector: 'tr'
theadSelector: 'tr'
tableName: 'myTableName'
type: 'csv'
worksheetName: 'WorksheetName'
```

```ignoreColumn``` can be either an array of indexes (i.e. [0, 2]) or field names (i.e. ["id", "name"]).
* Indexes correspond to the position of the header elements `th` in the DOM starting at 0. (If the `th` elements are removed or added to the DOM, the indexes will be shifted so use the functionality wisely!)
* Field names should correspond to the values set on the "data-field" attribute of the header elements `th` in the DOM.
* "Nameless" columns without data-field attribute will be named by their index number (converted to a string)

To disable formatting of numbers in the exported output, which can be useful for csv and excel format, set the option ``` numbers: output ``` to ``` false ```.

Set the option ``` excelFileFormat ``` to ``` 'xmlss' ``` if you want to export in XML Spreadsheet 2003 file format. Use this format if multiple tables should be exported into a single file. Excel 2000 html format is the default excel file format which has better support of exporting table styles.

The ``` excelstyles ``` option lets you define the css attributes of the original html table cells, that should be taken over when exporting to an excel worksheet (Excel 2000 html format only).

To export in XSLX format [protobi/js-xlsx](https://github.com/protobi/js-xlsx) forked from [SheetJS/js-xlsx](https://github.com/SheetJS/js-xlsx) is used. Please note that the implementation of this format type lets you only export table data, but not any styling information of the html table.

For jspdf options see the documentation of [jsPDF](https://github.com/MrRio/jsPDF) and [jsPDF-AutoTable](https://github.com/simonbengtsson/jsPDF-AutoTable) resp.

There is an extended setting for ``` jsPDF option 'format' ```. Setting the option value to ``` 'bestfit' ``` lets the tableExport plugin try to choose the minimum required paper format and orientation in which the table (or tables in multitable mode) completely fits without column adjustment.

Also there is an extended setting for the ``` jsPDF-AutoTable options 'fillColor', 'textColor' and 'fontStyle'```. When setting these option values to ``` 'inherit' ``` the original css values for background and text color will be used as fill and text color while exporting to pdf. A css font-weight >= 700 results in a bold fontStyle and the italic css font-style will be used as italic fontStyle.

When exporting to pdf the option ``` outputImages ``` lets you enable or disable the output of images that are located in the original html table.


Optional html data attributes
=============================
(can be applied while generating the table that you want to export)

<h4>data-tableexport-cellformat</h4>

```html
<td data-tableexport-cellformat="">...</td> -> An empty data value preserves format of cell content. E.g. no number seperator conversion
                                               
                                               More cell formats to be come...
```

<h4>data-tableexport-display</h4>

```html
<table style="display:none;" data-tableexport-display="always">...</table> -> A hidden table will be exported

<td style="display:none;" data-tableexport-display="always">...</td> -> A hidden cell will be exported

<td data-tableexport-display="none">...</td> -> This cell will not be exported

<tr data-tableexport-display="none">...</tr> -> All cells of this row will not be exported
```

<h4>data-tableexport-msonumberformat</h4>

```html
<td data-tableexport-msonumberformat="\@">...</td> -> Data value will be used to style excel cells with mso-number-format (Excel 2000 html format only)
                                                      Examples:
                                                      "\@"       excel treats cell content alway as text, even numbers
                                                      "0"        excel will display no decimals for numbers
                                                      "0\.000"   excel displays numbers with 3 decimals
                                                      "0%"       excel will display a number as percent with no decimals
                                                      "Percent"  excel will display a number as percent with 2 decimals
```

<h4>data-tableexport-value</h4>

```html
<th data-tableexport-value="export title">title</th> -> "export title" instead of "title" will be exported

<td data-tableexport-value="export content">content</td> -> "export content" instead of "content" will be exported
```
