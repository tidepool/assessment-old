package  
{	
	public class PictureData
	{
		public var url:String;
		public var time:Number;
		public var index:int;
		
		public function PictureData(u:String,t:Number) 
		{
			time = t;
			url = u;
			index =(int) (url.substr(url.lastIndexOf('/')+2,url.lastIndexOf('.')-url.lastIndexOf('/')-2));
		}
	}

}