	<!-- FAQ Section--------------------------------- -->
	<section id="tetra-faq" class="faqsec">
		<div class="faqdiv">
			<div class="faq1">
				<div class="faqtitle">@lang('home.faq')</div>
				<h2 class="faq2">@lang('home.faq_title')</h2>
				<p faqP>@lang('home.faq_p')</p>
			</div>


			@forelse ( $faq_questions as $question )
					<div class="tf-item faqitem">
				<button class="tf-q faqbtn" type="button" aria-expanded="false" aria-controls="tf-a-1" id="tf-q-1">
					<span>{{ $question->question }}</span>
					<span class="tf-ic faqspan" aria-hidden="true">▾</span>
				</button>
				<div class="tf-a faqanswer" id="tf-a-1" role="region" aria-labelledby="tf-q-1">
					<p class="faq_P">
						{{ $question->answer }}
					</p>
				</div>
			</div>
			@empty
				<p>@lang('home.no_faq')</p>
			@endforelse
		

		

		

		
		</div>
	</section>
	<!-- faq end -->