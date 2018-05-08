$(document).ready(function() {
    /*
     * Dropdown
    **/

    

    /*
     * Validation
    **/

    $("[data-new-validate]").click(function() {
        var $target = $($(this).data("new-validate")); 

        var validator = new FormValidator($target);

        validator.clear();

        validator.validate();

        validator.mark();

        $target.data("form-validator", validator);

        if (validator.isValid()) {
            $target.submit();
        }
    });

    $("[data-validate]").click(function() {
        var $target = $($(this).data("validate")); 
        var data = [];
        var formValid = true;

        $target.find("span.error").remove();
        $target.find("input.error").removeClass("error");

        $target.find("input, textarea").each(function(index, value) {
            var values = {
                key: typeof $(this).attr('name') == "undefined" ? 
                    (typeof $(this).attr('id') == "undefined" ? "_undefined_key" : $(this).attr('id')) : $(this).attr('name'),
                data: typeof $(this).data("table") === "undefined" ? "user" : $(this).data("table"),
                validationType: typeof $(this).attr("type") == "undefined" ? "text" : $(this).attr("type"),
                type: $(this).prop('nodeName').toLowerCase(),
                required: $(this).hasClass("required") ? "required" : "",
                rel: "",
                value: $(this).val()
            };

   		    data.push(values);

            if (! isValid(values)) {
            	$(this).addClass("error");
            	$(this).before("<span class=\"error\">" + lg["field_required"] + "</span>");
            	formValid = false;
            }
        });

        if (formValid) {
        	var senderName = getValueByKeyFromFormData("name", data);
        	var senderEmail = getValueByKeyFromFormData("email", data);

			send_form_data(senderName, senderEmail, data, function(output) {
				if (output == "ok") {
					$target.append("<div class=\"result success center\">" + lg["sent" ] + "</div>");
					
					$target.find("input, textarea").val("");
				} else {
					// $target.html("<div class=\"result error center\">" + output + "</div>");
				}
			});
        }
    });
});

function getValueByKeyFromFormData(key, data) {
	for (var n = 0; n < data.length; ++n) {
		if (data[n].key == key) {
			return data[n].value;
		}
	}

	return null;
}

function isValid(data) {
	if (data.required == "required" && data.value.length <= 0) {
		return false;
	}	

	switch (data.validationType) {
		case "email": return isValidEmail(data.value);
			break;
		case "phone":
		case "tel": return isNumeric(data.value);
			break;	
	}

	return true;
}

function isValidEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function isNumeric(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function FieldValidator($element) {
    this.$element = $element;

    this.getValue = function() {
        return this.$element.val();
    };

    this.isValid = function() {
        return (this.isRequired() ? Validate.is.filled(this.$element.val()) : true) && this.isMatchingType() && this.isMatching();
    };

    this.isRequired = function() {
        var required = this.$element.data("is-required");

        return typeof required != "undefined" ? required : false;
    };

    this.isMatchingType = function() {
        var is = this.$element.data("is");

        return typeof is != "undefined" ? window["Validate"]["is"][is](this.$element.val()) : true;
    };

    this.isMatching = function() {
        var matches = this.$element.data("is-match");

        return typeof matches != "undefined" ? Validate.is.match(this.$element, $(matches)) : true;
    };

    this.mark = function() {
        if (this.isValid()) {
            return;
        }

        this.$element.before("<span class=\"error\">" + lg["field_required"] + "</span>");

        this.$element.addClass("error");
    };

    this.getCMSData = function() {
        return {
            key: typeof this.$element.attr('name') == "undefined" ? (
                typeof this.$element.attr('id') == "undefined" ?  "" : this.$element.attr('id')) : this.$element.attr('name'),
            data: typeof this.$element.data("table") === "undefined" ? "user" : this.$element.data("table"),
            type: this.$element.prop('nodeName').toLowerCase(),
            required: this.$element.hasClass("required") ? "required" : "",
            rel: "",
            value: this.$element.val()
        };
    };
}

function FormValidator($element) {
    this.$element = $element;
    this.fields = [];

    this.validate = function() {
        var self = this;

        this.$element.find("input, textarea").each(function(index, value) {
            var field = new FieldValidator($(this));

            self.fields.push(field);
        });

        self.$element.trigger("validated", this);

        return this;
    };

    this.isValid = function() {
        for (nth in this.fields) {
            if (! this.fields[nth].isValid()) {
                return false;
            }
        }

        return true;
    }

    this.mark = function() {
        for (nth in this.fields) {
            this.fields[nth].mark();
        }
    };

    this.clear = function() {
        this.$element.find("span.error").remove();
        this.$element.find(".error").removeClass("error");
    };

    this.clearFields = function() {
        this.$element.find("input, textarea").val("");
    }

    this.getCMSLoginData = function() {
        var data = {};

        for (nth in this.fields) {
            var field = this.fields[nth].getCMSData();

            data[field.key] = field.value;
        }

        return data;
    };

    this.getCMSData = function() {
        var data = {};

        var n = 0;

        for (nth in this.fields) {
             data[n] = this.fields[nth].getCMSData();

             n++;
        }

        return data;
    };

    this.submitToCMS = function(name, email) {
        var self = this;

        send_form_data(name, email, this.getCMSData(), function(output) {
            self.$element.trigger("sentToCMS", [{
                result: output,
                success: output == "ok"
            }]);
        });
    };
}

var Validate = {
    is: {
        email: function(value) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(value);
        },

        numeric: function(value) {
            return !isNaN(parseFloat(value)) && isFinite(value);
        },

        match: function($one, $two) {
           return $one.val() == $two.val();
        },

        filled: function(value) {
            return value.length > 0;
        }
    }
};