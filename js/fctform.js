//Bride le nombre de caractère dans un champ input incompatible avec maxlength (type number par exemple)

function maxLengthCheck(object)
    {
      if (object.value.length > object.maxLength)
        object.value = object.value.slice(0, object.maxLength);
    }