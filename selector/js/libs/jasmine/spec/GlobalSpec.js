describe("Selector", function() {
  //iVars here
  console.log(contxt.appIteration);
  if(contxt.appIteration == 0){ 
    beforeEach(function() {
      loadFixtures('indexFixture.html');
      goSpyEvent         = spyOnEvent('#go', 'click');
      fireEvtSpy         = spyOn(window, "fireEvt")                        //Register fireEvt spy
      getOptionSpy       = spyOn(window, 'getOption').andCallThrough();    //andCallThrough calls the original function too since spy overrites the orig
      advanceSpy         = spyOn(window, 'advance').andCallThrough();
      updateContxtSpy    = spyOn(window, 'updateContxt').andCallThrough();    
      $this              = $($('li:not(".inactive") a.selected', contxt.current));
      sel                = $('#go').trigger('click', $this);                        
      $this.trigger('selection', $this);
      fireEvt("selection", $this);

      if(contxt.appIteration > 0){
        advance();
      }
    });

    describe("Should be an object and have a default.current of #organization", function(){
      //A Spec: Contains one or more expectations about the unit of code.
      it("Should have some defaults setup", function() {
          //      ACTUAL         MATCHER  VALUE
          expect(typeof($)).toEqual('function');
          expect(typeof(contxt)).toEqual('object');
          expect(contxt.current).toBe('#organization');
      });
    });
    describe("On click event should fire the custom event selection", function(){

      it("#go .on click have a context of document and a selector of #go", function() {
          expect(sel.context).toEqual(document);
          expect(sel.selector).toEqual("#go");
      });
      it("#go .on click should click a span with a class of triangle", function() {
          expect(sel[0].innerHTML).toEqual('<span class="triangle"></span>');
      });
      //Using a Jasmine Spy to similuate a method call
      it("#go .on click should trigger the selection event", function() {
          expect(goSpyEvent).toHaveBeenTriggered();
      });
      it("Selection event should trigger fireEvt method", function() {
          expect(fireEvt).toHaveBeenCalledWith("selection", $this);
      });

    });
    describe("getOption($this) sets some options and updates header text for a 1/1/1 selection", function(){
        it("should set some options", function() {
          expect(typeof(contxt)).toEqual("object");
          getOption($this);
          expect(getOption).toHaveBeenCalledWith($this);
          expect(contxt.choices).toEqual(['organization', 'country', 'branch']);

          expect(getOptionSpy.callCount).toEqual(1);      //Should only have fired getOption($this) once
        });
        it("realm is currently targeted item, $this", function() {
          expect(contxt.realm).toEqual($this);
        });
        it("target should be 'Save The Children'", function() {
          expect(contxt.target).toBe('Save The Children');
        });
        it("type should be 'organization'", function() {
          expect(contxt.type).toBe('organization');
        });
        it("type should be 'organization'", function() {
          expect(contxt.type).toBe('organization');
        });
        it("current.selector should be '#organization'", function() {
          expect(contxt.current.selector).toBe('#organization');
        });
        it("nextI, next index in choices array should be 1", function() {
          expect(contxt.nextI).toBe(1);
        });
        it("prevI, should be undefined", function() {
          expect(contxt.prevI).toBeUndefined();
        });
        it("contxt.header should be 'Select a country'", function() {
          expect(contxt.header).toBe('Select a country');
        });
        it("Sets the html of the #nameTag header to Select a country", function(){
          expect($('#nameTag').html()).toEqual('Select a country');
        });
    });

    describe("advance() Sets a jQuery object ($selN) equal to the next selection, animates, and updateContxt", function(){
        beforeEach(function(){
          advance();
        });
        it("Expects $selN to be a jQuery object", function(){
          expect(typeof($selN)).toEqual('object');
          expect(typeof($selN.hide)).toEqual('function');
        });
        it("$selN should be targeting '#country'", function(){
          expect($selN.attr('id')).toEqual('country');
        });
        it("advance() is only called once", function(){
          expect(advanceSpy.callCount).toEqual(1); 
        });
    });

    describe("updateContxt updates the contxt object to the new state of the app and changes the header.", function(){
      beforeEach(function(){
          updateContxt();
          console.log(contxt.appIteration);
      });
      it("updateContxt has been called", function(){
          expect(updateContxt).toHaveBeenCalled();
      });
      it("updateContxt has been called only once", function(){
          expect(updateContxtSpy.callCount).toEqual(1); 
      });
      it("getOption has been called only once", function(){
          expect(updateContxtSpy.callCount).toEqual(1); 
      });
    });
  }
  
  afterEach(function(){});
}); //End Global Selector Description