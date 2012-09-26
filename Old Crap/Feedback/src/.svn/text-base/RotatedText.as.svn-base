package 
{
   import flash.display.Sprite;
   import flash.events.Event;
   import flash.text.AntiAliasType;
   import flash.text.TextField;
   import flash.text.TextFieldAutoSize;
   import flash.text.TextFormat;
   
   public class RotatedText extends Sprite 
   {
      [Embed(mimeType = "application/x-font", embedAsCFF = "false",
         systemFont="Courier New",
         fontName = "fontName",
         fontStyle = "normal",
         fontWeight="normal")]   
      static public const EMBED_FONT:Class;
      
      public function RotatedText(main:Main)
      {
         var field:TextField = new TextField();
         field.embedFonts = true;
         field.antiAliasType = AntiAliasType.ADVANCED;
         field.defaultTextFormat = new TextFormat("fontName", 18);
         field.autoSize = TextFieldAutoSize.LEFT;
         field.text = "RotatedText";
         field.x = 1000;
         field.y = 500;
         main.addChild(field);
         
         main.addEventListener(Event.ENTER_FRAME, function(e:Event):void { field.rotation += 1; })
      }
      
   }
   
}
