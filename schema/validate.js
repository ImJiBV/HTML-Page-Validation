class FormValidator {
    constructor(form, fields) {
        this.form = form
        this.fields = fields
    }  
  
    initialize() {
        this.validateOnEntry()
        this.validateOnSubmit()
    }
  
    validateOnSubmit() {
    let self = this
    
    this.form.addEventListener('submit', e => {
                e.preventDefault()
                self.fields.forEach(field => {
                const input = document.querySelector(`#${field}`)
                self.validateFields(input)
            })
        })
    }
  
    validateOnEntry() {
        let self = this
            this.fields.forEach(field => {
                const input = document.querySelector(`#${field}`)
            
                input.addEventListener('input', event => {
                    self.validateFields(input)
                })
            })
    }
  
    validateFields(field) {
  
        if (field.value.trim() === "") {
            this.setStatus(field, `${field.previousElementSibling.innerText} cannot be blank`, "error")
        } else {
            this.setStatus(field, null, "success")
        }
        
        if (field.type === "email") {
            const re = /\S+@\S+\.\S+/
            if (re.test(field.value)) {
                this.setStatus(field, null, "success")
            } else {
                this.setStatus(field, "Please enter valid email address", "error")
            }
        }

        if (field.id === "mobileNumber") {
            const mobileRe = /^(09)\d{9}$/
            if (field.value.trim() == "") {
                this.setStatus(field, `${field.previousElementSibling.innerText} cannot be blank`, "error")
            }

            else if (mobileRe.test(field.value)) {
                this.setStatus(field, null, "success")
            } else {
                this.setStatus(field, "Please enter a valid PH mobile number (e.g., 09171234567)", "error")
            }
        }

        if (field.id === "gender") {
            if (field.value.trim() == "select") {
                this.setStatus(field, "Please select your gender", "error");
            } else {
                this.setStatus(field, null, "success");
            }
        }
    }

    setStatus(field, message, status) {
        const successIcon = field.parentElement.querySelector('.is-success')
        const errorIcon = field.parentElement.querySelector('.is-error')
        const errorMessage = field.parentElement.querySelector('.error-message')

        if (status === "success") {
            if (errorIcon) { errorIcon.classList.add('hidden') }
            if (errorMessage) { errorMessage.innerText = "" }
                successIcon.classList.remove('hidden')
                field.classList.remove('input-error')
        } 
        
        if (status === "error") {
            if (successIcon) { successIcon.classList.add('hidden') }
            field.parentElement.querySelector('.error-message').innerText = message
            errorIcon.classList.remove('hidden')
            field.classList.add('input-error')
        }    
    }
}

const form = document.querySelector('.form')
const fields = ["fullName", "email", "mobileNumber", "birthDate", "age", "gender"]

const validator = new FormValidator(form, fields)
validator.initialize()