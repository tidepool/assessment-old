package  
{
	import flash.display.FrameLabel;
	/**
	 * ...
	 * @author Wei
	 */
	public class UserData 
	{
		public var name:String;
		public var pictureURL:String;
		public var workType:String;//send the work type, and I will compare whether the user and his friends are similar or not.
		
		public var description:String;
		
		public var cloud:String;
		public var frames:Array;
		public var space:Number;
		private var main:Main;
		
		public  var company:String;
		
		public function UserData(m:Main, n:String,p:String,p_company:String,p_workType:String="",p_des:String="",p_cloud:String="interest",p_frames:String="",p_space:Number=0) 
		{
			name = n;
			pictureURL = p;
			company = p_company;
			
			workType = p_workType;
			description = p_des;
			cloud = p_cloud;
			frames = p_frames.split(/,/);
			space = p_space;
			main = m;
		}
		
		public function PrintOut(y:int):void
		{
			var string:String = "Name: " + name + " WorkType: " + workType;
			new Label (main, 800, y, string, 14, 1400);
			string = "Frames:\t";
			
			for (var i:int = 0; i < frames.length; i++) 
			{
				string += "\t" + frames[i];
			}
			new Label (main, 800, y+25, string, 14, 1400);
		}
		
	}

}