
# src/templates/part.form.sh

TMPLNAME+=('part.dropdown')
TMPLDESC['part.dropdown']="Bootstrap dropdown partial."
TMPLFUNC['part.dropdown']=templates_part_dropdown

function templates_part_dropdown {
  
  local dst=$1

  printf -- "    Creating ${dst}.\n"
    
  cat > ${dst}<<FORM

<div class="dropdown">
  <button class="btn dropdown-toggle sr-only" type="button" id="dropdownMenu1" data-toggle="dropdown">
    Dropdown
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
  </ul>
</div>
  
FORM

}
