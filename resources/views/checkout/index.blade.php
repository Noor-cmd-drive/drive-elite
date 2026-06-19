@extends('frontend.layout')

@section('title', 'Secure Payment - Drive Elite')

@section('content')
<style>
    /* Custom Scrollbar for Bank Dropdown */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.05); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(249, 115, 22, 0.5); border-radius: 10px; }
</style>

<div class="relative min-h-screen pt-32 pb-20 overflow-hidden bg-[#0b1120]">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-500/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4">
        <div class="mb-12 border-l-4 border-orange-500 pl-6">
            <h2 class="font-poppins text-4xl font-black text-white italic uppercase tracking-tighter">Secure <span class="text-orange-500">Payment</span></h2>
            <p class="text-gray-400 text-sm mt-1 uppercase tracking-widest font-bold">Manage your transaction via Admin-Verified Methods</p>
        </div>

        <form action="{{ route('bookings.store.web') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            <input type="hidden" name="total_days" value="{{ $total_days }}">
            <input type="hidden" name="total_price" value="{{ $total_price }}">
            <input type="hidden" name="user_bank" id="user_bank_input" value="">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <div class="lg:col-span-1">
                    <div class="bg-white/5 backdrop-blur-3xl rounded-[2.5rem] p-8 border border-white/10 shadow-2xl sticky top-32">
                        <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-3">
                            <i class="fa-solid fa-receipt text-orange-500"></i> Reservation Summary
                        </h3>
                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-gray-400 italic">Vehicle:</span>
                                <span class="text-white font-bold">{{ $car->brand }} {{ $car->model_name }}</span>
                            </div>
                            <div class="flex justify-between border-b border-white/5 pb-3">
                                <span class="text-gray-400 italic">Total Investment:</span>
                                <span class="text-orange-500 font-black text-xl">Rs. {{ number_format($total_price) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <label class="cursor-pointer group">
                            <input type="radio" name="payment_method" value="jazzcash" class="hidden peer" required>
                            <div class="p-6 bg-white/5 border border-white/10 rounded-3xl peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all flex items-center gap-4 hover:bg-white/10">
                                <div class="w-14 h-14 bg-[#111] rounded-xl flex items-center justify-center relative overflow-hidden border border-[#333] shadow-[0_4px_15px_rgba(237,28,36,0.3)]">
                                    <div class="absolute -right-3 -top-3 w-10 h-10 bg-[#ed1c24] rounded-full blur-xl opacity-50"></div>
                                    <div class="flex flex-col items-center justify-center z-10 leading-[0.9]">
                                        <span class="font-black italic text-[11px] text-white tracking-tighter font-sans">Jazz</span>
                                        <span class="font-black italic text-[11px] text-[#ed1c24] tracking-tighter font-sans">Cash</span>
                                    </div>
                                </div>
                                <div><p class="text-white font-black text-sm uppercase">JazzCash</p><p class="text-gray-500 text-[10px]">Instant Wallet</p></div>
                            </div>
                        </label>

                        <label class="cursor-pointer group">
                            <input type="radio" name="payment_method" value="easypaisa" class="hidden peer">
                            <div class="p-6 bg-white/5 border border-white/10 rounded-3xl peer-checked:border-green-500 peer-checked:bg-green-500/10 transition-all flex items-center gap-4 hover:bg-white/10">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#00c853] to-[#009624] rounded-xl flex items-center justify-center relative overflow-hidden shadow-[0_4px_15px_rgba(0,200,83,0.4)] border border-[#00e676]/50">
                                    <svg class="absolute bottom-0 left-0 w-full h-1/2 text-white/20" viewBox="0 0 100 50" preserveAspectRatio="none"><path d="M0,50 C30,20 70,20 100,50 Z" fill="currentColor"/></svg>
                                    <span class="font-black text-white text-[22px] tracking-tighter font-sans lowercase z-10">e<span class="text-[#ccff90]">p</span></span>
                                </div>
                                <div><p class="text-white font-black text-sm uppercase">EasyPaisa</p><p class="text-gray-500 text-[10px]">Instant Wallet</p></div>
                            </div>
                        </label>

                        <label class="cursor-pointer group">
                            <input type="radio" name="payment_method" value="bank" class="hidden peer">
                            <div class="p-6 bg-white/5 border border-white/10 rounded-3xl peer-checked:border-blue-500 peer-checked:bg-blue-500/10 transition-all flex items-center gap-4 hover:bg-white/10">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#1d4ed8] to-[#1e3a8a] rounded-xl flex items-center justify-center text-white text-xl shadow-[0_4px_15px_rgba(29,78,216,0.3)] border border-[#3b82f6]/40">
                                    <i class="fa-solid fa-building-columns"></i>
                                </div>
                                <div><p class="text-white font-black text-sm uppercase">Bank Transfer</p><p class="text-gray-500 text-[10px]">Pakistani Banks</p></div>
                            </div>
                        </label>

                        <label class="cursor-pointer group">
                            <input type="radio" name="payment_method" value="pickup" class="hidden peer">
                            <div class="p-6 bg-white/5 border border-white/10 rounded-3xl peer-checked:border-white peer-checked:bg-white/5 transition-all flex items-center gap-4 hover:bg-white/10">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#374151] to-[#1f2937] rounded-xl flex items-center justify-center text-white text-xl shadow-[0_4px_15px_rgba(55,65,81,0.3)] border border-[#4b5563]/50">
                                    <i class="fa-solid fa-car"></i>
                                </div>
                                <div><p class="text-white font-black text-sm uppercase">Pay at Pickup</p><p class="text-gray-500 text-[10px]">In-Person Cash</p></div>
                            </div>
                        </label>
                    </div>

                    <div id="dynamic-details" class="hidden animate-in fade-in slide-in-from-top-4 duration-500">
                        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 shadow-inner">
                            <div id="method-info" class="mb-8">
                                </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-[10px] font-black text-orange-500 uppercase tracking-widest mb-2 block ml-2">Transaction ID (TID)</label>
                                    <input type="text" name="transaction_id" placeholder="Paste your TID here" class="w-full bg-[#0b1120] border border-white/10 text-white rounded-2xl py-4 px-6 outline-none focus:border-orange-500 transition-all">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-orange-500 uppercase tracking-widest mb-2 block ml-2">Proof (Screenshot)</label>
                                    <input type="file" name="payment_proof" class="w-full text-gray-400 text-xs file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-orange-500 file:text-white cursor-pointer hover:file:bg-orange-600 transition-all">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-poppins font-black py-6 rounded-3xl shadow-[0_20px_50px_rgba(249,115,22,0.3)] hover:-translate-y-1 transition-all uppercase tracking-[0.2em] italic">
                        Confirm Elite Booking
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('input[name="payment_method"]');
        const details = document.getElementById('dynamic-details');
        const info = document.getElementById('method-info');
        const bankInput = document.getElementById('user_bank_input');

        const adminData = {
            jazzcash: {
                title: "JazzCash Mobile Wallet",
                account: "{{ $settings['jazzcash_number'] ?? 'Not Set (Update in Admin)' }}",
                name: "{{ $settings['jazzcash_name'] ?? 'Not Set' }}"
            },
            easypaisa: {
                title: "EasyPaisa Mobile Wallet",
                account: "{{ $settings['easypaisa_number'] ?? 'Not Set (Update in Admin)' }}",
                name: "{{ $settings['easypaisa_name'] ?? 'Not Set' }}"
            },
            bank: {
                title: "Bank Account Details",
                account: "{{ $settings['bank_iban'] ?? 'Not Set (Update in Admin)' }}",
                name: "{{ $settings['bank_title'] ?? 'Not Set' }}",
                bank_name: "{{ $settings['bank_name'] ?? 'Bank' }}"
            }
        };

        const bankList = [
            { name: "National Bank (NBP)", color: "#008751", short: "NBP", full: "NBP" },
            { name: "Meezan Bank", color: "#5c2d91", short: "M", full: "Meezan" },
            { name: "Habib Bank Limited (HBL)", color: "#00826b", short: "HBL", full: "HBL" },
            { name: "United Bank Limited (UBL)", color: "#0063a6", short: "UBL", full: "UBL" },
            { name: "MCB Bank", color: "#f58220", short: "MCB", full: "MCB" },
            { name: "Allied Bank (ABL)", color: "#f05123", short: "ABL", full: "ABL" },
            { name: "Bank Alfalah", color: "#e4002b", short: "BAFL", full: "Alfalah" },
            { name: "Faysal Bank", color: "#004b87", short: "FBL", full: "Faysal" },
            { name: "SadaPay", color: "#ff6a59", short: "S", full: "SadaPay" },
            { name: "NayaPay", color: "#fc6c05", short: "N", full: "NayaPay" }
        ];

        function buildCustomDropdown() {
            let optionsHtml = bankList.map(b => `
                <div class="bank-option flex items-center gap-3 p-3 hover:bg-white/10 cursor-pointer transition-colors" data-value="${b.name}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-black text-[9px] text-white shadow-sm" style="background-color: ${b.color}; border-bottom: 2px solid rgba(0,0,0,0.2);">
                        ${b.short}
                    </div>
                    <span class="text-white text-xs font-bold">${b.name}</span>
                </div>
            `).join('');

            return `
                <div class="relative mt-2" id="custom-bank-select">
                    <div id="selected-bank" class="w-full bg-[#0b1120] border border-white/10 text-white rounded-xl py-3 px-4 text-xs outline-none cursor-pointer flex justify-between items-center hover:border-blue-500 transition-colors">
                        <span class="flex items-center gap-3"><i class="fa-solid fa-building-columns text-gray-500"></i> Select Your Bank</span>
                        <i class="fa-solid fa-chevron-down text-gray-500"></i>
                    </div>
                    <div id="bank-dropdown-menu" class="hidden absolute top-full left-0 w-full mt-2 bg-[#1f2937] border border-white/10 rounded-xl shadow-2xl z-50 max-h-48 overflow-y-auto custom-scrollbar">
                        ${optionsHtml}
                    </div>
                </div>
            `;
        }

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'pickup') {
                    details.classList.add('hidden');
                    bankInput.value = ''; 
                } else {
                    details.classList.remove('hidden');
                    let html = '';
                    
                    if (this.value === 'bank') {
                        html = `
                            <div class="flex flex-col md:flex-row gap-6 items-center bg-blue-500/5 p-6 rounded-3xl border border-blue-500/10">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#1d4ed8] to-[#1e3a8a] rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg border border-[#3b82f6]/40 flex-shrink-0">
                                    <i class="fa-solid fa-building-columns"></i>
                                </div>
                                <div class="flex-1 text-center md:text-left">
                                    <p class="text-blue-500 font-black text-[10px] uppercase tracking-widest mb-1 italic">${adminData.bank.bank_name}</p>
                                    <p class="text-white text-xl md:text-2xl font-bold mb-1 tracking-widest">${adminData.bank.account}</p>
                                    <p class="text-gray-400 text-xs italic">Title: <span class="text-white font-bold">${adminData.bank.name}</span></p>
                                </div>
                                <div class="w-full md:w-72">
                                    <label class="text-[9px] text-gray-500 font-bold uppercase block tracking-widest">Sending from which bank?</label>
                                    ${buildCustomDropdown()}
                                </div>
                            </div>`;
                        
                        info.innerHTML = html;

                        setTimeout(() => {
                            const selectBox = document.getElementById('selected-bank');
                            const menu = document.getElementById('bank-dropdown-menu');
                            const options = document.querySelectorAll('.bank-option');

                            selectBox.addEventListener('click', () => { menu.classList.toggle('hidden'); });

                            options.forEach(opt => {
                                opt.addEventListener('click', () => {
                                    const val = opt.getAttribute('data-value');
                                    const bankData = bankList.find(b => b.name === val);
                                    
                                    selectBox.innerHTML = `
                                        <span class="flex items-center gap-3">
                                            <div class="w-6 h-6 rounded flex items-center justify-center font-black text-[7px] text-white" style="background-color: ${bankData.color};">
                                                ${bankData.short}
                                            </div>
                                            ${val}
                                        </span>
                                        <i class="fa-solid fa-chevron-down text-gray-500"></i>
                                    `;
                                    bankInput.value = val;
                                    menu.classList.add('hidden');
                                });
                            });

                            document.addEventListener('click', (e) => {
                                if (!document.getElementById('custom-bank-select').contains(e.target)) {
                                    menu.classList.add('hidden');
                                }
                            });
                        }, 100);

                    } else {
                        const isJazz = this.value === 'jazzcash';
                        const color = isJazz ? 'orange' : 'green';
                        
                        const bigLogo = isJazz 
                            ? `<div class="w-16 h-16 bg-[#111] rounded-2xl flex items-center justify-center relative overflow-hidden border-2 border-[#ed1c24]/50 shadow-[0_10px_30px_rgba(237,28,36,0.3)] flex-shrink-0">
                                 <div class="absolute -right-4 -top-4 w-12 h-12 bg-[#ed1c24] rounded-full blur-xl opacity-60"></div>
                                 <div class="flex flex-col items-center justify-center z-10 leading-[0.9]">
                                     <span class="font-black italic text-sm text-white tracking-tighter font-sans">Jazz</span>
                                     <span class="font-black italic text-sm text-[#ed1c24] tracking-tighter font-sans">Cash</span>
                                 </div>
                               </div>`
                            : `<div class="w-16 h-16 bg-gradient-to-br from-[#00c853] to-[#009624] rounded-2xl flex items-center justify-center relative overflow-hidden shadow-[0_10px_30px_rgba(0,200,83,0.4)] border-2 border-[#00e676]/50 flex-shrink-0">
                                 <svg class="absolute bottom-0 left-0 w-full h-1/2 text-white/20" viewBox="0 0 100 50" preserveAspectRatio="none"><path d="M0,50 C30,20 70,20 100,50 Z" fill="currentColor"/></svg>
                                 <span class="font-black text-white text-3xl tracking-tighter font-sans lowercase z-10">e<span class="text-[#ccff90]">p</span></span>
                               </div>`;

                        html = `
                            <div class="flex flex-col md:flex-row gap-6 items-center bg-${color}-500/5 p-6 rounded-3xl border border-${color}-500/10">
                                ${bigLogo}
                                <div class="flex-1 text-center md:text-left">
                                    <p class="text-${color}-500 font-black text-[10px] uppercase tracking-widest mb-1 italic">${adminData[this.value].title}</p>
                                    <p class="text-white text-3xl md:text-4xl font-black italic mb-1 tracking-wider">${adminData[this.value].account}</p>
                                    <p class="text-gray-400 text-sm italic">Account Title: <span class="text-white font-bold">${adminData[this.value].name}</span></p>
                                </div>
                            </div>`;
                        info.innerHTML = html;
                        bankInput.value = ''; 
                    }
                }
            });
        });
    });
</script>
@endsection