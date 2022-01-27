<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v8/services/campaign_experiment_service.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V8\Services;

class CampaignExperimentService
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Http::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Api\Resource::initOnce();
        \GPBMetadata\Google\Protobuf\Duration::initOnce();
        \GPBMetadata\Google\Protobuf\FieldMask::initOnce();
        \GPBMetadata\Google\Api\Client::initOnce();
        \GPBMetadata\Google\Protobuf\Any::initOnce();
        \GPBMetadata\Google\Rpc\Status::initOnce();
        \GPBMetadata\Google\Protobuf\GPBEmpty::initOnce();
        \GPBMetadata\Google\Longrunning\Operations::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
Jgoogle/ads/googleads/v8/enums/campaign_experiment_traffic_split_type.protogoogle.ads.googleads.v8.enums"�
&CampaignExperimentTrafficSplitTypeEnum"`
"CampaignExperimentTrafficSplitType
UNSPECIFIED 
UNKNOWN
RANDOM_QUERY

COOKIEB�
!com.google.ads.googleads.v8.enumsB\'CampaignExperimentTrafficSplitTypeProtoPZBgoogle.golang.org/genproto/googleapis/ads/googleads/v8/enums;enums�GAA�Google.Ads.GoogleAds.V8.Enums�Google\\Ads\\GoogleAds\\V8\\Enums�!Google::Ads::GoogleAds::V8::Enumsbproto3
�
>google/ads/googleads/v8/enums/campaign_experiment_status.protogoogle.ads.googleads.v8.enums"�
CampaignExperimentStatusEnum"�
CampaignExperimentStatus
UNSPECIFIED 
UNKNOWN
INITIALIZING
INITIALIZATION_FAILED
ENABLED
	GRADUATED
REMOVED
	PROMOTING
PROMOTION_FAILED	
PROMOTED
ENDED_MANUALLY
B�
!com.google.ads.googleads.v8.enumsBCampaignExperimentStatusProtoPZBgoogle.golang.org/genproto/googleapis/ads/googleads/v8/enums;enums�GAA�Google.Ads.GoogleAds.V8.Enums�Google\\Ads\\GoogleAds\\V8\\Enums�!Google::Ads::GoogleAds::V8::Enumsbproto3
�
9google/ads/googleads/v8/enums/response_content_type.protogoogle.ads.googleads.v8.enums"o
ResponseContentTypeEnum"T
ResponseContentType
UNSPECIFIED 
RESOURCE_NAME_ONLY
MUTABLE_RESOURCEB�
!com.google.ads.googleads.v8.enumsBResponseContentTypeProtoPZBgoogle.golang.org/genproto/googleapis/ads/googleads/v8/enums;enums�GAA�Google.Ads.GoogleAds.V8.Enums�Google\\Ads\\GoogleAds\\V8\\Enums�!Google::Ads::GoogleAds::V8::Enumsbproto3
�
;google/ads/googleads/v8/resources/campaign_experiment.proto!google.ads.googleads.v8.resourcesJgoogle/ads/googleads/v8/enums/campaign_experiment_traffic_split_type.protogoogle/api/field_behavior.protogoogle/api/resource.protogoogle/api/annotations.proto"�
CampaignExperimentJ
resource_name (	B3�A�A-
+googleads.googleapis.com/CampaignExperiment
id (B�AH �K
campaign_draft (	B.�A�A(
&googleads.googleapis.com/CampaignDraftH�
name (	H�
description (	H�\'
traffic_split_percent (B�AH��
traffic_split_type (2h.google.ads.googleads.v8.enums.CampaignExperimentTrafficSplitTypeEnum.CampaignExperimentTrafficSplitTypeB�AK
experiment_campaign (	B)�A�A#
!googleads.googleapis.com/CampaignH�i
status	 (2T.google.ads.googleads.v8.enums.CampaignExperimentStatusEnum.CampaignExperimentStatusB�A(
long_running_operation (	B�AH�

start_date (	H�
end_date (	H�:v�As
+googleads.googleapis.com/CampaignExperimentDcustomers/{customer_id}/campaignExperiments/{campaign_experiment_id}B
_idB
_campaign_draftB
_nameB
_descriptionB
_traffic_split_percentB
_experiment_campaignB
_long_running_operationB
_start_dateB
	_end_dateB�
%com.google.ads.googleads.v8.resourcesBCampaignExperimentProtoPZJgoogle.golang.org/genproto/googleapis/ads/googleads/v8/resources;resources�GAA�!Google.Ads.GoogleAds.V8.Resources�!Google\\Ads\\GoogleAds\\V8\\Resources�%Google::Ads::GoogleAds::V8::Resourcesbproto3
�"
Bgoogle/ads/googleads/v8/services/campaign_experiment_service.proto google.ads.googleads.v8.services;google/ads/googleads/v8/resources/campaign_experiment.protogoogle/api/annotations.protogoogle/api/client.protogoogle/api/field_behavior.protogoogle/api/resource.proto#google/longrunning/operations.protogoogle/protobuf/empty.proto google/protobuf/field_mask.protogoogle/rpc/status.proto"j
GetCampaignExperimentRequestJ
resource_name (	B3�A�A-
+googleads.googleapis.com/CampaignExperiment"�
 MutateCampaignExperimentsRequest
customer_id (	B�AV

operations (2=.google.ads.googleads.v8.services.CampaignExperimentOperationB�A
partial_failure (
validate_only (i
response_content_type (2J.google.ads.googleads.v8.enums.ResponseContentTypeEnum.ResponseContentType"�
CampaignExperimentOperation/
update_mask (2.google.protobuf.FieldMaskG
update (25.google.ads.googleads.v8.resources.CampaignExperimentH 
remove (	H B
	operation"�
!MutateCampaignExperimentsResponse1
partial_failure_error (2.google.rpc.StatusQ
results (2@.google.ads.googleads.v8.services.MutateCampaignExperimentResult"�
MutateCampaignExperimentResult
resource_name (	R
campaign_experiment (25.google.ads.googleads.v8.resources.CampaignExperiment"�
CreateCampaignExperimentRequest
customer_id (	B�AW
campaign_experiment (25.google.ads.googleads.v8.resources.CampaignExperimentB�A
validate_only ("?
 CreateCampaignExperimentMetadata
campaign_experiment (	"z
!GraduateCampaignExperimentRequest 
campaign_experiment (	B�A
campaign_budget (	B�A
validate_only ("@
"GraduateCampaignExperimentResponse
graduated_campaign (	"[
 PromoteCampaignExperimentRequest 
campaign_experiment (	B�A
validate_only ("W
EndCampaignExperimentRequest 
campaign_experiment (	B�A
validate_only ("�
(ListCampaignExperimentAsyncErrorsRequestJ
resource_name (	B3�A�A-
+googleads.googleapis.com/CampaignExperiment

page_token (	
	page_size ("h
)ListCampaignExperimentAsyncErrorsResponse"
errors (2.google.rpc.Status
next_page_token (	2�
CampaignExperimentService�
GetCampaignExperiment>.google.ads.googleads.v8.services.GetCampaignExperimentRequest5.google.ads.googleads.v8.resources.CampaignExperiment"M���75/v8/{resource_name=customers/*/campaignExperiments/*}�Aresource_name�
CreateCampaignExperimentA.google.ads.googleads.v8.services.CreateCampaignExperimentRequest.google.longrunning.Operation"����="8/v8/customers/{customer_id=*}/campaignExperiments:create:*�Acustomer_id,campaign_experiment�AZ
google.protobuf.EmptyAgoogle.ads.googleads.v8.services.CreateCampaignExperimentMetadata�
MutateCampaignExperimentsB.google.ads.googleads.v8.services.MutateCampaignExperimentsRequestC.google.ads.googleads.v8.services.MutateCampaignExperimentsResponse"\\���="8/v8/customers/{customer_id=*}/campaignExperiments:mutate:*�Acustomer_id,operations�
GraduateCampaignExperimentC.google.ads.googleads.v8.services.GraduateCampaignExperimentRequestD.google.ads.googleads.v8.services.GraduateCampaignExperimentResponse"u���I"D/v8/{campaign_experiment=customers/*/campaignExperiments/*}:graduate:*�A#campaign_experiment,campaign_budget�
PromoteCampaignExperimentB.google.ads.googleads.v8.services.PromoteCampaignExperimentRequest.google.longrunning.Operation"����H"C/v8/{campaign_experiment=customers/*/campaignExperiments/*}:promote:*�Acampaign_experiment�A.
google.protobuf.Emptygoogle.protobuf.Empty�
EndCampaignExperiment>.google.ads.googleads.v8.services.EndCampaignExperimentRequest.google.protobuf.Empty"`���D"?/v8/{campaign_experiment=customers/*/campaignExperiments/*}:end:*�Acampaign_experiment�
!ListCampaignExperimentAsyncErrorsJ.google.ads.googleads.v8.services.ListCampaignExperimentAsyncErrorsRequestK.google.ads.googleads.v8.services.ListCampaignExperimentAsyncErrorsResponse"]���GE/v8/{resource_name=customers/*/campaignExperiments/*}:listAsyncErrors�Aresource_nameE�Agoogleads.googleapis.com�A\'https://www.googleapis.com/auth/adwordsB�
$com.google.ads.googleads.v8.servicesBCampaignExperimentServiceProtoPZHgoogle.golang.org/genproto/googleapis/ads/googleads/v8/services;services�GAA� Google.Ads.GoogleAds.V8.Services� Google\\Ads\\GoogleAds\\V8\\Services�$Google::Ads::GoogleAds::V8::Servicesbproto3'
        , true);
        static::$is_initialized = true;
    }
}

