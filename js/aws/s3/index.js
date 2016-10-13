var AWS = require('aws-sdk');

// AWS.config.loadFromPath('/Users/busson-arnaud/.aws/credentials');

var s3 = new AWS.S3({
    // accessKeyId: 'AKIAJGRRKNU3TE7L5I7Q',
    // secretAccessKey : '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',
    // region : 'eu-west-1'
});

 // s3.createBucket({Bucket: 'whiskylogger2'}, function() {
 //   var body = [
 //       {
 //         id: 1,
 //         'name' : 'toto'
 //     },
 //     {
 //       id : 2,
 //       'name' : 'tata'
 //     }
 //   ];
 //    var params = {Bucket: 'whiskylogger', Key: 'whiskies.json', Body: JSON.stringify(body)};
    // var params = {Bucket: 'whiskylogger2', Key: 'whiskies.json', Body : };

    s3.listBuckets(function(err, data) {

        if (err){

            console.log(err)

        }else{
          console.log(data);
          // console.log("Successfully uploaded data to myBucket/myKey");
        }

     });

// });
