export function generateDateRangeYYYYMM(lastMonths) {
	let result = [];
	const today = new Date();
	const y = today.getFullYear();
	const m = today.getMonth() + 1;
	let yb  = 0;
	let cy  = y;
	let cm  = m;

	/* @TODO If lastMonths is negative number then generate future dates */
	const mux = lastMonths < 0 ? -1 : 1;
	lastMonths = Math.abs(lastMonths);
	for (let i = 1; i <= lastMonths; i++) {

		// Year behind
		if (m - i === -1) {
			cy = cy - 1;
			cm = 12;
		} else if (m - i !== 0 && (i - m) % 12 === 0) {
			cy = cy - 1;
			cm = 12;
		}

		let obj = {
			key: `${cy}-${getMonthString(cm - 1)}`,
			value: `${getMonthName(cm - 1)} ${cy}`
		}

		result.push(obj);
		cm = cm - 1;
	}

	return result;
}

export function getMonthName(monthIndex) {
	let tab = [
		"January", 		"Fabruary",
		"March", 		"April",
		"May", 			"June",
		"July", 		"August",
		"Septemer", 	"October",
		"November", 	"December"
	];
	monthIndex = monthIndex % 12;

	return tab[monthIndex];
}

export function getMonthString(monthIndex) {
	monthIndex += 1;
	if (monthIndex < 10)
		return `0${monthIndex}`;

	return monthIndex;
}

export function getDateString(dateNumber) {
	if (dateNumber < 10)
		return `0${dateNumber}`;

	return dateNumber;
}

export function generateFromToSearchQuery(dateRangeStr) {
	const startDateStr = `${dateRangeStr}-01`;
	const temp = new Date(startDateStr);
	const endDateObj = new Date(temp.getFullYear(), temp.getMonth() + 1, 0);
	const endDateStr = `${dateRangeStr}-${endDateObj.getDate()}`;

	return { from: startDateStr, to: endDateStr };

}


// @TODO @BUG Doesn't work when argument crosses last 2 years
// console.log(generateDateRangeYYYYMM(24));