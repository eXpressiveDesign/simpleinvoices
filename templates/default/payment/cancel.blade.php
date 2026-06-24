<div class="container-xl py-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body text-center py-5">
					<div class="mb-4">
						<span class="avatar avatar-xl bg-yellow-lt">
							<i class="ti ti-alert-triangle" style="font-size:2.5rem;color:#f76707;"></i>
						</span>
					</div>
					<h3 class="mb-2">{{ $LANG['payment_cancelled_title'] ?? 'Payment Cancelled' }}</h3>
					<p class="text-muted mb-4">{{ $LANG['payment_cancelled_message'] ?? 'Your payment was not completed. You can try again from your invoice.' }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
