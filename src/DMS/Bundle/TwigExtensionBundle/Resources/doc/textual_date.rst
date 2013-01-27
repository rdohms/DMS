# Textual Date Extension

The textual date extension makes it possible to print textual, relative dates
in twig. This means dates will be formatted to strings like the following:

* 1 minute ago
* in 5 days
* yesterday
* tomorrow

## Usage

This extension accepts only DateTime objects and can be used in any Twig
template.

`{{ mydate|textualDate }}`

It relies on the Symfony Translator service or anything that implements the 
`Symfony\Component\Translation\TranslatorInterface`.

Current available languages are available in: `Resources/translations` in 
`date.*.xliff` files. These files may be over-written if customization
is necessary, refer to Symfony Docs.