const validation = new JustValidate("#signup");

validation
    .addField("#pseudo", [
        {
            rule: "required"
        }
    ])
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        }
    ])
    .addField("#mdp", [
        {
            rule: "required"
        },
        {
            rule: "mdp"
        },
        {
            validator: (value) => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(json){
                        return json.available;
                    });
            },
            errorMessage: "L'email est déjà utilisé"
        }
    ])
    .addField("#mdp_confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#mdp"].elem.value;
            },
            errorMessage: "Les deux mots de passe doivent être identiques"
        }
    ])
    .addField("#date_naissance", [
        {
            rule: "required"
        },
        {
            rule: "date_naissance"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });
