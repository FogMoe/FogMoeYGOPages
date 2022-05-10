<?php
$allowedExts = array("zip", "7z");
$temp = explode(".", $_FILES["file"]["name"]);
echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "application/zip")
|| ($_FILES["file"]["type"] == "application/7z"))
&& ($_FILES["file"]["size"] < 10485760)   // 小于 10 mb
&& in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "错误：: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		if (file_exists("/home/ubuntu/carddata/" . $_FILES["file"]["name"]))
		{
			echo $_FILES["file"]["name"] . " 文件已经存在，请勿重复上传。 ";
		}
		else
		{
			// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
			move_uploaded_file($_FILES["file"]["tmp_name"], "/home/ubuntu/carddata/" . $_FILES["file"]["name"]);
			echo "上传完毕，请联系qq群管理员审核。 ";
		}
	}
}
else
{
	echo "非法的文件格式，只能上传Zip压缩文件";
}
?>