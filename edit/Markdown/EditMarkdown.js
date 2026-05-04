
Runner.controls.EditMarkdown = Runner.extend(Runner.controls.Control,{ 

	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);
		Runner.controls.EditMarkdown.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }

                var fieldValue = document.getElementById('current_' + this.valContId).innerHTML;
                // fieldValue = atob(fieldValue);  
                fieldValue = decodeBase64(fieldValue);
                
                this.editor = new toastui.Editor({
                el: document.querySelector("#"+this.valContId),
                height: this.getFieldSetting('height'),
                initialEditType: this.getFieldSetting('editType') , // 'markdown' or 'wysiwyg'
                previewStyle: 'vertical',
                usageStatistics: 'false',
                language: this.getFieldSetting('language'),
                initialValue: fieldValue
              });
      
                // editor.getHtml();

	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
                valor = this.editor.getMarkdown();
                console.log('valor: '+valor);
                var realCb = $("#" + this.valContId);
                var cbClone = document.createElement('input');
                $(cbClone).attr('type', 'hidden');
                $(cbClone).attr('id', realCb.attr('id'));
                $(cbClone).attr('name', realCb.attr('name'));
                $(cbClone).val(valor);
		return [cbClone];  
	}
});
        function decodeBase64(str) {
            // Decodifica el string Base64
            const decoded = atob(str);

            // Convierte los bytes a un string UTF-8
            const bytes = new Uint8Array(decoded.length);
            for (let i = 0; i < decoded.length; i++) {
                bytes[i] = decoded.charCodeAt(i);
            }
            return new TextDecoder().decode(bytes);
        }

Runner.controls.constants["EditMarkdown"] = "EditMardown";
