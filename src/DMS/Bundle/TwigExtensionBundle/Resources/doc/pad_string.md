# Pad String Extension

The pad string extension uses PHP's native str_pad function
to pad a string with a given character on the left, right or
both sides until the returned string reaches the specified
maximum length.

## Usage

This extension accepts three parameters; a pad character, an
integer specifying the maximum length of the returned string
and a string (optional) specifying which side to apply the
padding:

`{{ myString|padString('o', 4, 'STR_PAD_LEFT' }}`
`{{ myString|padString('o', 4, 'STR_PAD_BOTH' }}`
`{{ myString|padString('o', 4, 'STR_PAD_RIGHT' }}`
`{{ myString|padString('o', 4 }}`

If myString contained the value 'ps', the output of the above
would be:

* oops
* opso
* psoo
* psoo

Where no third argument is provided, the filter defaults to
STR_PAD_RIGHT.